<template>
  <div>
    <!-- 面包屑导航 -->
    <Breadcrumb titleTop="权限管理" titleBottom="角色列表"></Breadcrumb>

    <!-- 卡片 -->
    <el-card class="box-card">
      <el-row :gutter="20">
        <el-col :span="5">
          <el-button type="primary" @click="addDialogVisible = true">添加角色</el-button>
        </el-col>
      </el-row>
      <el-table :data="RolesList" border stripe style="width: 100%">
        <!-- 展开列 -->
        <el-table-column type="expand">
          <template slot-scope="scope">
            <!-- <pre style="font-size:6px">
              {{scope.row}}
            </pre>-->
            <el-row
              :class="['borderBottom',i1 === 0?'borderTop':'','vcenter']"
              v-for="(item1,i1) in scope.row.children"
              :key="item1.id"
            >
              <!-- 渲染一级权限 -->
              <el-col :span="5">
                <el-tag>{{item1.auth_name}}</el-tag>
                <i class="el-icon-caret-right"></i>
              </el-col>
              <!-- 渲染二级和三级权限 -->
              <el-col :span="19">
                <el-row
                  :class="[i2 === 0?'':'borderTop','vcenter']"
                  v-for="(item2,i2) in item1.children"
                  :key="item2.id"
                >
                  <!-- 渲染二级权限 -->
                  <el-col :span="6">
                    <el-tag type="success">{{item2.auth_name}}</el-tag>
                    <i class="el-icon-caret-right"></i>
                  </el-col>
                  <!-- 渲染三级权限 -->
                  <el-col :span="18">
                    <el-tag
                      type="warning"
                      v-for="item3 in item2.children"
                      :key="item3.id"
                      closable
                      @close="deleteRight(scope.row.id,item3.id)"
                    >{{item3.auth_name}}</el-tag>
                  </el-col>
                </el-row>
              </el-col>
            </el-row>
          </template>
        </el-table-column>
        <!-- 索引列 -->
        <el-table-column type="index" label="#"></el-table-column>
        <el-table-column prop="role_name" label="角色名称" width="180"></el-table-column>
        <el-table-column prop="role_remark" label="角色描述"></el-table-column>
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-button
              @click="openEditRole(scope.row.id)"
              type="primary"
              icon="el-icon-edit"
              size="mini"
            >编辑</el-button>
            <!-- <el-button
              @click="deleteRoles(scope.row.id)"
              type="danger"
              icon="el-icon-delete"
              size="mini"
            >删除</el-button>-->
            <el-button
              @click="openSetRight(scope.row)"
              type="warning"
              icon="el-icon-setting"
              size="mini"
            >分配权限</el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-card>

    <!-- 添加角色对话框 -->
    <el-dialog
      title="添加角色"
      :visible.sync="addDialogVisible"
      width="50%"
      @close="DialogClosed('addFormRef')"
    >
      <el-form ref="addFormRef" :model="editForm" label-width="70px">
        <el-form-item label="角色名称">
          <el-input v-model="addForm.role_name"></el-input>
        </el-form-item>
        <el-form-item label="角色备注">
          <el-input v-model="addForm.role_remark"></el-input>
        </el-form-item>
        <el-form-item label="角色权限">
          <el-tree
            ref="treeRef"
            :data="rightList"
            :props="treeProps"
            show-checkbox
            node-key="id"
            default-expand-all
          ></el-tree>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="addDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="addRole()">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 编辑角色对话框 -->
    <el-dialog
      title="编辑角色"
      :visible.sync="editDialogVisible"
      width="50%"
      @close="DialogClosed('editFormRef')"
    >
      <el-form ref="editFormRef" :model="editForm" label-width="70px">
        <el-form-item label="角色名称">
          <el-input v-model="editForm.role_name"></el-input>
        </el-form-item>
        <el-form-item label="角色备注">
          <el-input v-model="editForm.role_remark"></el-input>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="editDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="editRole()">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 分配权限dialog -->
    <el-dialog
      title="分配权限"
      :visible.sync="setRightDialogVisible"
      width="50%"
      @close="setRightDialogClose()"
    >
      <el-tree
        ref="treeRef"
        :data="rightList"
        :props="treeProps"
        show-checkbox
        node-key="id"
        :default-checked-keys="defKeys"
        default-expand-all
      ></el-tree>
      <span slot="footer" class="dialog-footer">
        <el-button @click="setRightDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="SetRight()">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from "vue-property-decorator";
import { httpGET, httpPut, httpDelete,httpPost } from "../../http/index";
@Component
export default class Role extends Vue {
  private RolesList: any[] = [];
  private editID: number = 0;
  private role_id_set: number = 0;
  private total: number = 0;
  private query: string = "";
  private pageList: any = {
    pageNum: 1,
    pageSize: 5
  };
  private addDialogVisible: boolean = false;
  private editDialogVisible: boolean = false;
  private setRightDialogVisible: boolean = false;
  private addForm = {};
  private editForm = {};
  private typeSelectList: any[] = [];
  private treeProps: any = {
    label: "auth_name",
    children: "children"
  };
  private defKeys: any[] = [];
  private rightList: any[] = [];

  created() {
    this.getRolesList();
    this.getRightTree();
  }
  private async getRolesList() {
    let { data: res } = await httpGET("roles");
    // console.log(res);
    if (res.meta.status === 200) {
      this.RolesList = res.data;
    } else {
      this.$message.error(res.meta.msg);
    }
  }

  private async getRightTree(){
    let { data: res } = await httpGET("menus/3");
    if (res.meta.status === 200) {
      this.rightList = res.data;
    } else {
      this.$message.error(res.meta.msg);
    }
  }

  private async openEditRole(role_id: number) {
    this.editID = role_id;
    let { data: res } = await httpGET(`role/${role_id}`);
    if (res.meta.status === 200) {
      this.editForm = res.data;
      this.editDialogVisible = true;
    } else {
      this.$message.error(res.meta.msg);
    }
  }

  private async editRole() {
    let editForm: any = this.editForm;
    editForm.id = this.editID;
    let { data: res } = await httpPut("role", editForm);
    if (res.meta.status === 200) {
      this.editDialogVisible = false;
      this.$message.success(res.meta.msg);
      this.getRolesList();
    } else {
      this.$message.error(res.meta.msg);
    }
  }

  private async openSetRight(role: any) {
    this.role_id_set = role.id;
    this.getLeafKeys(role, this.defKeys);
    this.setRightDialogVisible = true;
  }

  private setRightDialogClose() {
    this.defKeys = [];
  }

  // 获取角色下所有三级权限的id
  private getLeafKeys(node: any, arr: any) {
    let node_children = node.children;
    for (let i in node_children) {
      for (let j in node_children[i].children) {
        for (let k in node_children[i].children[j].children) {
          arr.push(node_children[i].children[j].children[k].id);
        }
      }
    }
  }

  private async SetRight() {
    let refs: any = this.$refs;
    let arr = [...refs.treeRef.getCheckedKeys()];
    console.log(arr)
    let { data: res } = await httpPut("right", {
      id: this.role_id_set,
      right_arr: arr
    });
    if (res.meta.status === 200) {
      this.setRightDialogVisible = false;
      this.$message.success(res.meta.msg);
      this.getRolesList();
    } else {
      this.$message.error(res.meta.msg);
    }
  }

  // 根据id删除rights
  private async deleteRight(role_id: number, operation_id: number) {
    let res: any = await httpDelete(
      this,
      "right",
      `${role_id}/${operation_id}`
    );
    if (res.data.meta.status == 200) {
      this.$message.success(res.data.meta.msg);
      this.getRolesList();
    } else {
      this.$message.error(res.data.meta.msg);
    }
  }

  private async addRole() {
    let refs: any = this.$refs;
    let right_arr = [...refs.treeRef.getCheckedKeys()];
    let addForm: any = this.addForm;
    addForm.right_arr = right_arr;
    // console.log(addForm)
    let { data: res } = await httpPost("role", addForm);
    if (res.meta.status === 200) {
      this.addDialogVisible = false;
      this.$message.success(res.meta.msg);
      this.getRolesList();
    } else {
      this.$message.error(res.meta.msg);
    }
  }

  //   监听对话框关闭清空
  private DialogClosed(FormRef: any) {
    let ref: any = this.$refs[FormRef];
    ref.resetFields();
  }
}
</script>

<style lang='less' scoped>
.el-tag {
  margin: 7px;
}
.borderTop {
  border-top: 1px solid #eee;
}
.borderBottom {
  border-bottom: 1px solid #eee;
}
.vcenter {
  display: flex;
  align-items: center;
}
</style>