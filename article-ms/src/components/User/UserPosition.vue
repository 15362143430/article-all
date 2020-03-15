<template>
  <div>
    <!-- 面包屑导航 -->
    <Breadcrumb titleTop="用户管理" titleBottom="用户城市分布"></Breadcrumb>

    <!-- 卡片 -->
    <el-card class="box-card">
      <el-table :data="UserPositionList" border stripe style="width: 100%">
        <el-table-column type="index" label="#"></el-table-column>
        <el-table-column prop="position" label="省份"></el-table-column>
        <el-table-column prop="total" label="人数"></el-table-column>
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
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from "vue-property-decorator";
import { getList } from "../../http/index";
@Component
export default class UserPosition extends Vue {
  private UserPositionList: any[] = [];
  private total: number = 0;
  private pageList: any = {
    pageNum: 1,
    pageSize: 5
  };

  created() {
    this.getUserPositionList(1, 5);
  }
  private async getUserPositionList(
    pageNum: number,
    pageSize: number,
  ) {
    let { data: res } = await getList("userPosition", pageNum, pageSize);
    // console.log(res);
    if (res.meta.status === 200) {
      this.UserPositionList = res.data.list;
      this.total = res.data.total;
    } else {
      this.UserPositionList = res.data.list;
      this.total = 0;
      this.$message.error(res.meta.msg);
    }
  }
  // 监听每页个数变化
  private handleSizeChange(newSize: number) {
    this.pageList.pageSize = newSize;
    this.getUserPositionList(
      this.pageList.pageNum,
      this.pageList.pageSize
    );
  }
  // 监听页码变化
  private handleCurrentChange(newNum: number) {
    this.pageList.pageNum = newNum;
    this.getUserPositionList(
      this.pageList.pageNum,
      this.pageList.pageSize
    );
  }
}
</script>

<style lang='less' scoped>
</style>