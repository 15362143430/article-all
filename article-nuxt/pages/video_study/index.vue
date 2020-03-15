<template>
  <div class="container">
    <div class="article-header">
      <p>HTML/CSS</p>
    </div>
    <div class="video-list">
      <nuxt-link :to="`/video_study/${item.id}`" v-for="item in HC" :key="item.id">
        <img :src="item.imgsrc" />
        <span class="video-title">{{item.title}}</span>
        <div class="list-bottom">
          <div>
            <i class="iconfont">&#xe64f;</i>
            <span class="type">{{item.type}}</span>
          </div>
          <div>
            <i class="iconfont">&#xe63b;</i>
            <i class="date">{{item.addtime}}</i>
          </div>
        </div>
      </nuxt-link>
    </div>

    <div class="article-header">
      <p>JavaScript</p>
    </div>
    <div class="video-list">
        <nuxt-link :to="`/video_study/${item.id}`" v-for="item in J" :key="item.id">
        <img :src="item.imgsrc" />
        <span class="video-title">{{item.title}}</span>
        <div class="list-bottom">
          <div>
            <i class="iconfont">&#xe64f;</i>
            <span class="type">{{item.type}}</span>
          </div>
          <div>
            <i class="iconfont">&#xe63b;</i>
            <i class="date">{{item.addtime}}</i>
          </div>
        </div>
      </nuxt-link>
    </div>

    <div class="article-header">
      <p>Vue</p>
    </div>
    <div class="video-list">
        <nuxt-link :to="`/video_study/${item.id}`" v-for="item in V" :key="item.id">
        <img :src="item.imgsrc" />
        <span class="video-title">{{item.title}}</span>
        <div class="list-bottom">
          <div>
            <i class="iconfont">&#xe64f;</i>
            <span class="type">{{item.type}}</span>
          </div>
          <div>
            <i class="iconfont">&#xe63b;</i>
            <i class="date">{{item.addtime}}</i>
          </div>
        </div>
      </nuxt-link>
    </div>

    <div class="article-header">
      <p>Nodejs</p>
    </div>
    <div class="video-list">
        <nuxt-link :to="`/video_study/${item.id}`" v-for="item in N" :key="item.id">
        <img :src="item.imgsrc" />
        <span class="video-title">{{item.title}}</span>
        <div class="list-bottom">
          <div>
            <i class="iconfont">&#xe64f;</i>
            <span class="type">{{item.type}}</span>
          </div>
          <div>
            <i class="iconfont">&#xe63b;</i>
            <i class="date">{{item.addtime}}</i>
          </div>
        </div>
      </nuxt-link>
    </div>
  </div>
</template>

<script>
import { httpGet } from "../../http/index";
export default {
  async asyncData() {
    let video_res = await httpGet("videos");
    // console.log(video_res.data.data)
    if (video_res.data.meta.status === 200) {
      let video_res_type = video_res.data.data;
      return {
        HC: video_res_type.HC,
        J: video_res_type.J,
        V: video_res_type.V,
        N: video_res_type.N
      };
    }
  },
  head() {
    return {
      title: "教学视频"
    };
  },
};
</script>

<style lang="less" scoped>
@import "../../assets/less/video_study.less";
</style>