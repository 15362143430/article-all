<template>
  <div class="container">
    <div id="video-left">
      <div id="video-header">
        <p>您当前的位置是：</p>
        <nuxt-link to="/">HOME</nuxt-link>&nbsp;&nbsp;>&nbsp;&nbsp;
        <nuxt-link to="/video_study">教学视频</nuxt-link>
      </div>

      <div id="titleContent">
        <p id="videoTitle">{{video_detail.title}}</p>
        <i class="iconfont">&#xe64f;</i>
        <span id="author">{{video_detail.author}}</span>&nbsp&nbsp&nbsp&nbsp
        <i class="iconfont">&#xe63b;</i>
        <span id="time">2019-09-01 04:35:56</span>
      </div>

      <div id="video-body">
        <video width="90%" height="auto" controls :src="video_detail.videosrc">
          <!--<source src="../video/水平垂直居中.ogg" type="video/ogg"> 您的浏览器不支持 HTML5 video 标签。-->
        </video>
      </div>
      <div id="nav-right">
        <div id="nav-right-top">
          <nuxt-link class="nav-a1" to="/article_list/html">
            <span>HTML</span>
          </nuxt-link>
          <nuxt-link class="nav-a2" to="/article_list/css">
            <span>CSS</span>
          </nuxt-link>
          <nuxt-link class="nav-a3" to="/article_list/javascript">
            <span>JavaScript</span>
          </nuxt-link>
        </div>
        <div id="nav-right-bottom">
          <nuxt-link class="nav-a4" to="/article_list/vue">
            <span>Vue</span>
          </nuxt-link>
          <nuxt-link class="nav-a5" to="/article_list/nodejs">
            <span>Nodejs</span>
          </nuxt-link>
          <nuxt-link class="nav-a6" to="/article_list/life">
            <span>生活趣事</span>
          </nuxt-link>
        </div>
      </div>
    </div>

    <div id="video-right">
      <h1>相关推荐</h1>
      <ul>
        <li v-for="item in same_video" :key="item.id">
          <img :src="item.imgsrc" />
          <span>
            <nuxt-link :to="`/video_study/${item.id}`">{{item.title}}</nuxt-link>
            <br />
            <br />
            <i class="iconfont">&#xe64f;</i>
            <span class="type">{{item.type}}</span>
          </span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { httpGet } from "../../http/index";
export default {
  async asyncData({ params }) {
    let video_detail = await httpGet("video/" + params.id);
    let type = video_detail.data.data.type;
    let same_video = await httpGet("videosbytype?type="+type);
    // console.log(same_video);
    // console.log(video_detail.data.data)
    if (video_detail.status === 200 && same_video.status === 200) {
      return {
        video_detail: video_detail.data.data,
        same_video: same_video.data.data
      };
    }
  },
  head() {
    return {
      title: "视频详情"
    };
  },
};
</script>

<style lang="less" scoped>
@import "../../assets/less/video_detail.less";
</style>