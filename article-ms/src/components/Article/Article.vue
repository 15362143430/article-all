<template>
  <div>
    <!-- 面包屑导航 -->
    <Breadcrumb titleTop="文章管理" titleBottom="文章列表"></Breadcrumb>

    <!-- 卡片 -->
    <el-card class="box-card">
      <el-row :gutter="20">
        <el-col :span="7">
          <el-input placeholder="请输入内容" v-model="query" class="input-with-select">
            <el-button @click="searchList()" slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </el-col>
        <el-col :span="5">
          <el-button type="primary" @click="addDialogVisible = true">添加文章</el-button>
        </el-col>
      </el-row>
      <el-table :data="ArticleList" border stripe style="width: 100%">
        <el-table-column type="index" label="#"></el-table-column>
        <el-table-column prop="title" label="文章标题" width="400"></el-table-column>
        <el-table-column prop="type" label="类型" width="100"></el-table-column>
        <el-table-column prop="addtime" label="创建时间"></el-table-column>
        <el-table-column prop="author" label="作者/搬运工" width="100"></el-table-column>
        <!-- <el-table-column prop="img_path" label="封面" width="250"></el-table-column> -->
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-tooltip :enterable="false" effect="dark" content="编辑文章" placement="top">
              <el-button
                @click="openEditArticle(scope.row.id)"
                type="primary"
                icon="el-icon-edit"
                size="mini"
              ></el-button>
            </el-tooltip>
            <el-tooltip :enterable="false" effect="dark" content="删除文章" placement="top">
              <el-button
                @click="deleteArticle(scope.row.id)"
                type="danger"
                icon="el-icon-delete"
                size="mini"
              ></el-button>
            </el-tooltip>
            <el-tooltip :enterable="false" effect="dark" content="文章预览" placement="top">
              <el-button
                @click="previewArticle(scope.row.id)"
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

    <!-- 添加文章对话框 -->
    <el-dialog
      title="添加文章"
      :visible.sync="addDialogVisible"
      width="50%"
      @close="DialogClosed('addFormRef')"
    >
      <el-form ref="addFormRef" :model="addForm" label-width="70px">
        <el-form-item label="文章标题">
          <el-input v-model="addForm.title"></el-input>
        </el-form-item>
        <el-form-item label="文章梗概">
          <el-input type="textarea" v-model="addForm.body"></el-input>
        </el-form-item>
        <el-form-item label="搬运工">
          <el-input v-model="addForm.author"></el-input>
        </el-form-item>
        <el-form-item label="文章类型">
          <el-select v-model="addForm.type" placeholder="请选择">
            <el-option
              v-for="item in typeSelectList"
              :key="item.type"
              :label="item.type"
              :value="item.type"
            ></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="文章文件">
          <el-upload
            ref="addUpload"
            action="http://localhost:3001/article"
            :data="addForm"
            :file-list="fileList"
            :auto-upload="false"
            :limit="1"
            name="article_md"
            :on-success="uploadSuccess"
          >
            <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
            <!-- <el-button
              style="margin-left: 10px;"
              size="small"
              type="success"
              @click="submitUpload"
            >上传到服务器</el-button>-->
            <div slot="tip" class="el-upload__tip">只能上传md文件</div>
          </el-upload>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="addDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="addArticle()">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 编辑文章对话框 -->
    <el-dialog
      title="编辑文章"
      :visible.sync="editDialogVisible"
      width="50%"
      @close="DialogClosed('editFormRef')"
    >
      <el-form ref="editFormRef" :model="addForm" label-width="70px">
        <el-form-item label="文章标题">
          <el-input v-model="editForm.title"></el-input>
        </el-form-item>
        <el-form-item label="文章梗概">
          <el-input type="textarea" v-model="editForm.body"></el-input>
        </el-form-item>
        <el-form-item label="搬运工">
          <el-input v-model="editForm.author"></el-input>
        </el-form-item>
        <el-form-item label="文章类型">
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
        <el-button @click="addDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="editArticle()">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 预览文章对话框 -->
    <el-dialog title="文章预览" :visible.sync="previewDialogVisible" width="70%">
      <div id="articleMd" v-html="MD"></div>
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
export default class Article extends Vue {
  private ArticleList: any[] = [];
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
  private addForm = {
    title: "",
    body: "",
    type: "",
    author: ""
  };
  private editForm = {};
  private typeSelectList: any[] = [];
  private fileList: any[] = [];
  private MD: any = "";

  created() {
    this.getArticleList(1, 5, "ms");
    this.getTypeSelectList();
  }
  private async getArticleList(
    pageNum: number,
    pageSize: number,
    params: string
  ) {
    let { data: res } = await getList("articles", pageNum, pageSize, params);
    // console.log(res);
    if (res.meta.status === 200) {
      this.ArticleList = res.data.list;
      this.total = res.data.total;
    } else {
      this.ArticleList = res.data.list;
      this.total = 0;
      this.$message.error(res.meta.msg);
    }
  }
  private async getTypeSelectList() {
    let { data: res } = await httpGET("articleTypeSelect");
    if (res.meta.status === 200) {
      this.typeSelectList = res.data;
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  private searchList() {
    this.getArticleList(
      this.pageList.pageNum,
      this.pageList.pageSize,
      `ms/${encodeURI(encodeURI(this.query))}`
    );
  }
  // 监听每页个数变化
  private handleSizeChange(newSize: number) {
    this.pageList.pageSize = newSize;
    this.getArticleList(
      this.pageList.pageNum,
      this.pageList.pageSize,
      `ms/${encodeURI(encodeURI(this.query))}`
    );
  }
  // 监听页码变化
  private handleCurrentChange(newNum: number) {
    this.pageList.pageNum = newNum;
    this.getArticleList(
      this.pageList.pageNum,
      this.pageList.pageSize,
      `ms/${encodeURI(encodeURI(this.query))}`
    );
  }
  //   监听对话框关闭清空
  private DialogClosed(FormRef: any) {
    let ref: any = this.$refs;
    ref[FormRef].resetFields();
  }
  // 删除文章
  private async deleteArticle(id: any) {
    let res: any = await httpDelete(this, "article", id);
    if (res.data.meta.status === 200) {
      this.getArticleList(
        this.pageList.pageNum,
        this.pageList.pageSize,
        `ms/${encodeURI(encodeURI(this.query))}`
      );
      this.$message.success(res.data.meta.msg);
    } else {
      this.$message.error(res.data.meta.msg);
    }
  }
  // 上传前的钩子函数
  // private beforeUpload(file:any){
  //   console.log(file);
  // }
  // 提交添加表单
  private addArticle() {
    let refs: any = this.$refs;
    refs.addUpload.submit();
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
  // 打开编辑弹窗
  private async openEditArticle(id: number) {
    this.editID = id;
    let { data: res } = await httpGET(`article/${id}`);
    if (res.meta.status === 200) {
      this.editForm = res.data;
      this.editDialogVisible = true;
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  // 提交编辑
  private async editArticle() {
    let editForm: any = this.editForm;
    editForm.id = this.editID;
    let { data: res } = await httpPut("article", editForm);
    if (res.meta.status === 200) {
      this.getArticleList(
        this.pageList.pageNum,
        this.pageList.pageSize,
        `ms/${encodeURI(encodeURI(this.query))}`
      );
      this.editDialogVisible = false;
      this.$message.success(res.meta.msg);
    } else {
      this.$message.error(res.meta.msg);
    }
  }
  // 文章预览
  private async previewArticle(id: number) {
    let { data: res } = await httpGET(`articlemd/${id}`);
    this.MD = res.data;
    this.previewDialogVisible = true;
  }

  // 监听预览窗口
  @Watch("previewDialogVisible")
  getPreviewDialogVisible(newValue: boolean, oldValue: boolean) {
    if (newValue === false) {
      this.MD = "";
    }
  }
}
</script>

<style lang='less' scoped>
#articleMd {
  width: 100%;
  height: 500px;
  overflow: scroll;
}
</style>