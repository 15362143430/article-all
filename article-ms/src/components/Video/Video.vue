<template>
  <div>
    <!-- 面包屑导航 -->
    <Breadcrumb titleTop="视频管理" titleBottom="视频列表"></Breadcrumb>

    <!-- 卡片 -->
    <el-card class="box-card">
      <el-row :gutter="20">
        <el-col :span="7">
          <el-input placeholder="请输入内容" v-model="query" class="input-with-select">
            <el-button @click="searchList()" slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </el-col>
        <el-col :span="5">
          <el-button type="primary" @click="addDialogVisible = true">添加视频</el-button>
        </el-col>
      </el-row>
      <el-table :data="VideosList" border stripe style="width: 100%">
        <el-table-column type="index" label="#"></el-table-column>
        <el-table-column prop="title" label="视频标题" width="250"></el-table-column>
        <el-table-column prop="type" label="类型"></el-table-column>
        <el-table-column prop="addtime" label="创建时间"></el-table-column>
        <el-table-column prop="author" label="作者/搬运工"></el-table-column>
        <!-- <el-table-column prop="imgsrc" label="封面" width="250"></el-table-column> -->
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-tooltip :enterable="false" effect="dark" content="编辑视频" placement="top">
              <el-button
                @click="openEditVideo(scope.row.id)"
                type="primary"
                icon="el-icon-edit"
                size="mini"
              ></el-button>
            </el-tooltip>
            <el-tooltip :enterable="false" effect="dark" content="删除视频" placement="top">
              <el-button
                @click="deleteVideo(scope.row.id)"
                type="danger"
                icon="el-icon-delete"
                size="mini"
              ></el-button>
            </el-tooltip>
            <el-tooltip :enterable="false" effect="dark" content="预览视频" placement="top">
              <el-button
                @click="previewVideo(scope.row.id)"
                type="warning"
                icon="el-icon-view"
                size="mini"
              ></el-button>
            </el-tooltip>
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

    <!-- 添加视频对话框 -->
    <el-dialog
      title="添加视频"
      :visible.sync="addDialogVisible"
      width="50%"
      @close="DialogClosed('addFormRef')"
    >
      <el-form ref="addFormRef" :model="addForm" label-width="70px">
        <el-form-item label="文章标题" prop="user_name">
          <el-input v-model="addForm.title"></el-input>
        </el-form-item>
        <el-form-item label="搬运工" prop="mobile">
          <el-input v-model="addForm.author"></el-input>
        </el-form-item>
        <el-form-item label="文章类型" prop="role">
          <el-select v-model="addForm.type" placeholder="请选择">
            <el-option
              v-for="item in typeSelectList"
              :key="item.type"
              :label="item.type"
              :value="item.type"
            ></el-option>
          </el-select>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="addDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="addVideo()">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 编辑视频对话框 -->
    <el-dialog
      title="编辑视频"
      :visible.sync="editDialogVisible"
      width="50%"
      @close="DialogClosed('editFormRef')"
    >
      <el-form ref="editFormRef" :model="editForm" label-width="70px">
        <el-form-item label="视频标题" prop="user_name">
          <el-input v-model="editForm.title"></el-input>
        </el-form-item>
        <el-form-item label="搬运工" prop="mobile">
          <el-input v-model="editForm.author"></el-input>
        </el-form-item>
        <el-form-item label="文章类型" prop="role">
          <el-select v-model="editForm.type" placeholder="请选择">
            <el-option
              v-for="item in typeSelectList"
              :key="item.type"
              :label="item.type"
              :value="item.type"
            ></el-option>
          </el-select>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="editDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="editVideo()">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 预览视频对话框 -->
    <el-dialog title="视频预览" :visible.sync="previewDialogVisible" width="50%">
      <video style="margin-left:20%" ref="video" src width="60%" height="40%" controls></video>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="previewDialogVisible = false">取 消</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue, Watch } from "vue-property-decorator";
import { getList, httpGET, httpDelete, httpPut } from "../../http/index";
@Component
export default class Video extends Vue {
  private VideosList: any[] = [];
  private editID: number = 0;
  private total: number = 0;
  private query: string = "";
  private pageList: any = {
    pageNum: 1,
    pageSize: 5
  };
  private addDialogVisible: boolean = false;
  private editDialogVisible: boolean = false;
  private previewDialogVisible: boolean = false;
  private addForm = {};
  private editForm = {};
  private typeSelectList: any[] = [];

  created() {
    this.getVideosList(1, 5);
    this.getTypeSelectList();
  }
  private async getVideosList(
    pageNum: number,
    pageSize: number,
    query: string = ""
  ) {
    let { data: res } = await getList("videosms", pageNum, pageSize, query);
    // console.log(res);
    if (res.meta.status === 200) {
      this.VideosList = res.data.list;
      this.total = res.data.total;
    } else {
      this.VideosList = res.data.list;
      this.total = 0;
      this.$message.error(res.meta.msg);
    }
  }
  private async getTypeSelectList() {
    let { data: res } = await httpGET("videoTypeSelect");
    if (res.meta.status === 200) {
      this.typeSelectList = res.data;
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  private searchList() {
    this.getVideosList(
      this.pageList.pageNum,
      this.pageList.pageSize,
      encodeURI(encodeURI(this.query))
    );
  }
  // 监听每页个数变化
  private handleSizeChange(newSize: number) {
    this.pageList.pageSize = newSize;
    this.getVideosList(
      this.pageList.pageNum,
      this.pageList.pageSize,
      encodeURI(encodeURI(this.query))
    );
  }
  // 监听页码变化
  private handleCurrentChange(newNum: number) {
    this.pageList.pageNum = newNum;
    this.getVideosList(
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
  // 删除视频
  private async deleteVideo(id: any) {
    let res: any = await httpDelete(this, "video", id);
    if (res.data.meta.status === 200) {
      this.getVideosList(
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
  private async openEditVideo(id: number) {
    this.editID = id;
    let { data: res } = await httpGET(`video/${id}`);
    if (res.meta.status === 200) {
      this.editForm = res.data;
      this.editDialogVisible = true;
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  // 提交编辑
  private async editVideo() {
    let editForm: any = this.editForm;
    editForm.id = this.editID;
    let { data: res } = await httpPut("video", editForm);
    if (res.meta.status === 200) {
      this.editDialogVisible = false;
      this.$message.success(res.meta.msg);
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  // 视频预览
  private async previewVideo(id: number) {
    this.previewDialogVisible = true;
    let { data: res } = await httpGET(`video/${id}`);
    let refs: any = this.$refs;
    refs.video.src = res.data.videosrc;
  }

  // 监听预览窗口的关闭
  @Watch('previewDialogVisible')
  getPreviewDialogVisible(newValue:boolean,oldValue:boolean){
    let refs: any = this.$refs;
    if(newValue === false){
      refs.video.src = '';
    }
  }
}
</script>

<style lang='less' scoped>
</style>