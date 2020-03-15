<template>
  <el-col>
    <!-- <div id="myChart" :style="{width: '300px', height: '300px'}"></div> -->
    <el-row id="count_tab" :gutter="20">
      <el-col :span="8">
        <div class="out-content bg-purple">
          <el-row type="flex" justify="space-around" align="middle">
            <el-col :span="11">
              <div class="in-content bg-purple-pink">
                <div>
                  <p>文章数量</p>
                  <p class="count">88(章)</p>
                </div>
                <i class="el-icon-notebook-1"></i>
              </div>
            </el-col>
            <el-col :span="11">
              <div class="in-content bg-purple-blue">
                <div>
                  <p>视频数量</p>
                  <p class="count">88(个)</p>
                </div>
                <i class="el-icon-video-camera"></i>
              </div>
            </el-col>
          </el-row>
        </div>
      </el-col>
      <el-col :span="16">
        <div class="out-content bg-purple">
          <el-row type="flex" justify="space-around" align="middle">
            <el-col :span="6">
              <div class="in-content bg-purple-green">
                <div>
                  <p>今日访问量</p>
                  <p class="count">88(次)</p>
                </div>
                <i class="el-icon-view"></i>
              </div>
            </el-col>
            <el-col :span="6">
              <div class="in-content bg-purple-blu">
                <div>
                  <p>用户数量</p>
                  <p class="count">88(个)</p>
                </div>
                <i class="el-icon-user"></i>
              </div>
            </el-col>
            <el-col :span="5">
              <div class="in-content bg-purple-bl">
                <div>
                  <p>新增用户</p>
                  <p class="count">88(个)</p>
                </div>
                <i class="el-icon-user"></i>
              </div>
            </el-col>
            <el-col :span="5">
              <div class="in-content bg-purple-zi">
                <div>
                  <p>文章更新</p>
                  <p class="count">88(章)</p>
                </div>
                <i class="el-icon-document-add"></i>
              </div>
            </el-col>
          </el-row>
        </div>
      </el-col>
    </el-row>
    <el-row id="echarts_tab" :gutter="20">
      <el-col :span="11">
        <div class="out-content bg-purple">
          <el-row type="flex" justify="space-around" align="middle">
            <el-col :span="22">
              <div class="in-content">
                <div id="pie_wenli"></div>
              </div>
            </el-col>
          </el-row>
        </div>
      </el-col>
      <el-col :span="13">
        <div class="out-content bg-purple">
          <el-row type="flex" justify="space-around" align="middle">
            <el-col :span="22">
              <div class="in-content">
                <div id="database"></div>
              </div>
            </el-col>
          </el-row>
        </div>
      </el-col>
    </el-row>
  </el-col>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from "vue-property-decorator";
import { pei_wenli } from "../echarts/pie";
import { database } from "../echarts/top10";
@Component
export default class Welecome extends Vue {
  mounted() {
    // this.drawLine();
    pei_wenli("pie_wenli");
    database("database");
  }
  drawLine() {
    // 基于准备好的dom，初始化echarts实例
    let that: any = this;
    let myChart = that.$echarts.init(document.getElementById("myChart"));
    // 绘制图表
    myChart.setOption({
      title: { text: "在Vue中使用echarts" },
      tooltip: {},
      xAxis: {
        data: ["衬衫", "羊毛衫", "雪纺衫", "裤子", "高跟鞋", "袜子"]
      },
      yAxis: {},
      series: [
        {
          name: "销量",
          type: "bar",
          data: [5, 20, 36, 10, 10, 20]
        }
      ]
    });
  }
}
</script>


<style lang='less' scoped>
@import "../assets/less/welecome.less";
</style>