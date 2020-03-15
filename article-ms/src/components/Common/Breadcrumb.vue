<template>
  <div>
    <el-breadcrumb separator-class='el-icon-arrow-right'>
      <el-breadcrumb-item :to="{ path: '/home' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>{{titleTop}}</el-breadcrumb-item>
      <el-breadcrumb-item>{{titleBottom}}</el-breadcrumb-item>
    </el-breadcrumb>
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class Breadcrumb extends Vue {
  @Prop() private titleTop!: string;
  @Prop() private titleBottom!: string;
}
</script>

<style lang='less' scoped>
</style>