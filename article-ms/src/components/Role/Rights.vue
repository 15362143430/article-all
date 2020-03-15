<template>
  <div>
    <!-- 面包屑导航 -->
    <Breadcrumb titleTop="角色管理" titleBottom="权限列表"></Breadcrumb>

    <!-- 卡片 -->
    <el-card class="box-card">
      <el-table :data="RightsList" border stripe style="width: 100%">
        <el-table-column type="index" label="#"></el-table-column>
        <el-table-column prop="auth_name" label="权限名称"></el-table-column>
        <el-table-column prop="level" label="层级">
          <template slot-scope="scope">
            <el-tag v-if="scope.row.level===1" type>顶层</el-tag>
            <el-tag v-else-if="scope.row.level===2" type="success">二层</el-tag>
            <el-tag v-else-if="scope.row.level===3" type="warning">三层</el-tag>
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
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from "vue-property-decorator";
import { getList } from "../../http/index";
@Component
export default class Rights extends Vue {
  private RightsList: any[] = [];
  private total: number = 0;
  private pageList: any = {
    pageNum: 1,
    pageSize: 5
  };

  created() {
    this.getRightsList(1, 5);
  }
  private async getRightsList(pageNum: number, pageSize: number) {
    let { data: res } = await getList("rights", pageNum, pageSize);
    // console.log(res);
    if (res.meta.status === 200) {
      this.RightsList = res.data.list;
      this.total = res.data.total;
    } else {
      this.RightsList = res.data.list;
      this.total = 0;
      this.$message.error(res.meta.msg);
    }
  }
  // 监听每页个数变化
  private handleSizeChange(newSize: number) {
    this.pageList.pageSize = newSize;
    this.getRightsList(this.pageList.pageNum, this.pageList.pageSize);
  }
  // 监听页码变化
  private handleCurrentChange(newNum: number) {
    this.pageList.pageNum = newNum;
    this.getRightsList(this.pageList.pageNum, this.pageList.pageSize);
  }
}
</script>

<style lang='less' scoped>
</style>