<template>
  <div>
    <!-- 面包屑导航 -->
    <Breadcrumb titleTop="用户管理" titleBottom="用户列表"></Breadcrumb>

    <!-- 卡片 -->
    <el-card class="box-card">
      <el-row :gutter="20">
        <el-col :span="7">
          <el-input placeholder="请输入用户名" v-model="query" class="input-with-select">
            <el-button @click="searchList()" slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </el-col>
        <el-col :span="5">
          <el-button type="primary" @click="addDialogVisible = true">添加用户</el-button>
        </el-col>
      </el-row>
      <el-table :data="UsersList" border stripe style="width: 100%">
        <el-table-column type="index" label="#"></el-table-column>
        <el-table-column prop="name" label="用户名"></el-table-column>
        <el-table-column prop="role_name" label="角色"></el-table-column>
        <el-table-column prop="email" label="邮箱"></el-table-column>
        <el-table-column prop="addtime" label="注册时间"></el-table-column>
        <el-table-column prop="position" label="注册地"></el-table-column>
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-tooltip :enterable="false" effect="dark" content="编辑用户" placement="top">
              <el-button
                @click="openEditUser(scope.row.id)"
                type="primary"
                icon="el-icon-edit"
                size="mini"
              ></el-button>
            </el-tooltip>
            <el-tooltip :enterable="false" effect="dark" content="删除用户" placement="top">
              <el-button
                @click="deleteUser(scope.row.id)"
                type="danger"
                icon="el-icon-delete"
                size="mini"
              ></el-button>
            </el-tooltip>
            <!-- <el-tooltip :enterable="false" effect="dark" content="分配角色" placement="top">
              <el-button
                @click="setRole(scope.row.id,scope.row.rid)"
                type="warning"
                icon="el-icon-setting"
                size="mini"
              ></el-button>
            </el-tooltip>-->
          </template>
        </el-table-column>
      </el-table>

      <!-- 分页 -->
      <el-pagination
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        :page-sizes="[5, 10, 15, 20]"
        :page-size="5"
        layout="total, sizes, prev, pager, next, jumper"
        :total="total"
      ></el-pagination>
    </el-card>

    <!-- 添加用户对话框 -->
    <el-dialog
      title="添加用户"
      :visible.sync="addDialogVisible"
      width="50%"
      @close="DialogClosed('addFormRef')"
    >
      <el-form ref="addFormRef" :model="addForm" label-width="70px">
        <el-form-item label="用户头像">
          <el-upload
            ref="addUpload"
            action="http://localhost:3001/register"
            :data="addForm"
            :file-list="fileList"
            :auto-upload="false"
            :limit="1"
            name="avator"
            :on-success="uploadSuccess"
            list-type="picture-card"
            :before-upload="beforeAvatarUpload"
          >
            <el-dialog :visible.sync="dialogVisible">
              <img width="100%" :src="dialogImageUrl" alt />
            </el-dialog>
            <!-- <el-button slot="trigger" size="small" type="primary">选取文件</el-button> -->

            <div slot="tip" class="el-upload__tip">只能上传图片文件</div>
          </el-upload>
        </el-form-item>
        <el-form-item label="用户名">
          <el-input v-model="addForm.name"></el-input>
        </el-form-item>
         <el-form-item label="邮箱">
          <el-input v-model="addForm.email"></el-input>
        </el-form-item>
        <el-form-item label="密码">
          <el-input v-model="addForm.password"></el-input>
        </el-form-item>
        <el-form-item label="角色身份">
          <el-radio-group v-model="addForm.role_id">
            <el-radio
              v-for="item in roleSelectList"
              :key="item.id"
              :label="item.id"
            >{{item.role_name}}</el-radio>
          </el-radio-group>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="addDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="addUser()">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 编辑用户对话框 -->
    <el-dialog
      title="编辑用户"
      :visible.sync="editDialogVisible"
      width="50%"
      @close="DialogClosed('editFormRef')"
    >
      <el-form ref="editFormRef" :model="editForm" label-width="70px">
        <el-form-item label="用户名">
          <el-input v-model="editForm.name"></el-input>
        </el-form-item>
        <el-form-item label="用户定位">
          <el-input v-model="editForm.position"></el-input>
        </el-form-item>
        <el-form-item label="角色身份">
          <el-radio-group v-model="editForm.role_id">
            <el-radio
              v-for="item in roleSelectList"
              :key="item.id"
              :label="item.id"
            >{{item.role_name}}</el-radio>
          </el-radio-group>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="editDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="editUser()">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from "vue-property-decorator";
import { getList, httpGET, httpDelete, httpPut,httpPositon } from "../../http/index";
@Component
export default class User extends Vue {
  private UsersList: any[] = [];
  private editID: number = 0;
  private total: number = 0;
  private query: string = "";
  private pageList: any = {
    pageNum: 1,
    pageSize: 5
  };
  private addDialogVisible: boolean = false;
  private editDialogVisible: boolean = false;
  private addForm: any = {};
  private editForm: any = {
    name: "",
    position: "",
    role_id: 0
  };
  private roleSelectList: any[] = [];
  private fileList: any[] = [];
  dialogImageUrl = "";
  dialogVisible: boolean = false;

  created() {
    this.getUsersList(1, 5);
    this.getRoleSelectList();
  }
  private async getUsersList(
    pageNum: number,
    pageSize: number,
    query: string = ""
  ) {
    let { data: res } = await getList("users", pageNum, pageSize, query);
    // console.log(res);
    if (res.meta.status === 200) {
      this.UsersList = res.data.list;
      this.total = res.data.total;
    } else {
      this.UsersList = res.data.list;
      this.total = 0;
      this.$message.error(res.meta.msg);
    }
  }
  private async getRoleSelectList() {
    let { data: res } = await httpGET("roleTypeSelect");
    if (res.meta.status === 200) {
      this.roleSelectList = res.data;
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  private searchList() {
    this.getUsersList(
      this.pageList.pageNum,
      this.pageList.pageSize,
      encodeURI(encodeURI(this.query))
    );
  }
  // 监听每页个数变化
  private handleSizeChange(newSize: number) {
    this.pageList.pageSize = newSize;
    this.getUsersList(
      this.pageList.pageNum,
      this.pageList.pageSize,
      encodeURI(encodeURI(this.query))
    );
  }
  // 监听页码变化
  private handleCurrentChange(newNum: number) {
    this.pageList.pageNum = newNum;
    this.getUsersList(
      this.pageList.pageNum,
      this.pageList.pageSize,
      encodeURI(encodeURI(this.query))
    );
  }
  //   监听对话框关闭清空
  private DialogClosed(FormRef: any) {
    let ref: any = this.$refs[FormRef];
    ref.resetFields();
  }
  // 删除用户
  private async deleteUser(id: any) {
    console.log(id);
    let res: any = await httpDelete(this, "user", id);
    if (res.data.meta.status === 200) {
      this.getUsersList(
        this.pageList.pageNum,
        this.pageList.pageSize,
        encodeURI(encodeURI(this.query))
      );
      this.$message.success(res.data.meta.msg);
    } else {
      this.$message.error(res.data.meta.msg);
    }
  }

  // 打开编辑弹窗
  private async openEditUser(id: number) {
    this.editID = id;
    let { data: res } = await httpGET(`user/${id}`);
    if (res.meta.status === 200) {
      this.editForm.name = res.data.name;
      this.editForm.position = res.data.position;
      this.editForm.role_id = res.data.role_id;
      this.editDialogVisible = true;
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  // 提交编辑
  private async editUser() {
    let editForm: any = this.editForm;
    editForm.id = this.editID;
    // console.log(editForm);
    let { data: res } = await httpPut("user", editForm);
    if (res.meta.status === 200) {
      this.editDialogVisible = false;
      this.$message.success(res.meta.msg);
      this.getUsersList(
        this.pageList.pageNum,
        this.pageList.pageSize,
        encodeURI(encodeURI(this.query))
      );
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  // 上传成功钩子
  private uploadSuccess(res: any) {
    if (res.meta.status === 200) {
      this.addDialogVisible = false;
      this.$message.success(res.meta.msg);
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  // 提交添加表单
  private async addUser() {
    let {data:res} = await httpPositon();
    this.addForm.position = res.regionName;
    let refs: any = this.$refs;
    refs.addUpload.submit();
  }
  // 上传前钩子
  beforeAvatarUpload(file:any) {
        const isJPG = file.type === 'image/jpeg';
        const isLt2M = file.size / 1024 / 1024 < 2;

        if (!isJPG) {
          this.$message.error('上传头像图片只能是 JPG 格式!');
        }
        if (!isLt2M) {
          this.$message.error('上传头像图片大小不能超过 2MB!');
        }
        return isJPG && isLt2M;
      }
}
</script>

<style lang='less' scoped>
</style>