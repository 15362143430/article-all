<template>
  <div>
    <!-- 面包屑导航 -->
    <Breadcrumb titleTop="视频管理" titleBottom="分类列表"></Breadcrumb>

    <!-- 卡片 -->
    <el-card class="box-card">
      <el-table :data="videosTypeList" border stripe style="width: 100%">
        <el-table-column type="index" label="#"></el-table-column>
        <el-table-column prop="type" label="视频类型"></el-table-column>
        <el-table-column prop="total" label="视频数量"></el-table-column>
      </el-table>
    </el-card>
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from "vue-property-decorator";
import { httpGET } from "../../http/index";
@Component
export default class VideoType extends Vue {
  private videosTypeList: any[] = [];

  created() {
    this.getVideoTypeList();
  }
  private async getVideoTypeList() {
    let { data: res } = await httpGET("videostype");
    // console.log(res);
    if (res.meta.status === 200) {
      this.videosTypeList = res.data;
    } else {
      this.$message.error(res.meta.msg);
    }
  }
}
</script>

<style lang='less' scoped>
</style>