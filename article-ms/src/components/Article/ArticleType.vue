<template>
  <div>
    <!-- 面包屑导航 -->
    <Breadcrumb titleTop="文章管理" titleBottom="分类列表"></Breadcrumb>

    <!-- 卡片 -->
    <el-card class="box-card">
      <el-table :data="articlesTypeList" border stripe style="width: 100%">
        <el-table-column type="index" label="#"></el-table-column>
        <el-table-column prop="name" label="文章类型"></el-table-column>
        <el-table-column prop="value" label="文章数量"></el-table-column>
      </el-table>
    </el-card>
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from "vue-property-decorator";
import { httpGET } from "../../http/index";
@Component
export default class VideoType extends Vue {
  private articlesTypeList: any[] = [];

  created() {
    this.getArticleTypeList();
  }
  private async getArticleTypeList() {
    let { data: res } = await httpGET("articlestype");
    // console.log(res);
    if (res.meta.status === 200) {
      this.articlesTypeList = res.data;
    } else {
      this.$message.error(res.meta.msg);
    }
  }
}
</script>

<style lang='less' scoped>
</style>