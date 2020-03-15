<template>
  <div class="container">
    <div>
      <div id="article">
        <div id="article-header">
          <p>您当前的位置是：</p>
          <nuxt-link to="/">HOME</nuxt-link>&nbsp;&nbsp;>&nbsp;&nbsp;
          <nuxt-link
            id="typea"
            :to="`/article_list/${article_detail.lowType}`"
          >{{article_detail.type}}</nuxt-link>
        </div>
        <div id="titleContent">
          <p id="articleTitle">{{article_detail.title}}</p>
          <i class="iconfont">&#xe64f;</i>
          <span id="author">{{article_detail.author}}</span>&nbsp&nbsp&nbsp&nbsp
          <i class="iconfont">&#xe63b;</i>
          <span id="time">{{article_detail.addtime}}</span>
        </div>

        <div id="article-body" v-html="article_content"></div>
      </div>
    </div>
    <div id="nav-right">
        <nuxt-link class="nav-a1" to="/article_list/html">
          <span>HTML</span>
        </nuxt-link>
        <nuxt-link class="nav-a2" to="/article_list/css">
          <span>CSS</span>
        </nuxt-link>
        <nuxt-link class="nav-a3" to="/article_list/javascript">
          <span>JavaScript</span>
        </nuxt-link>
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

    <!-- <div id="catalog">
      <div id="nav-right">
        <div id="nav-right-top">
          <a class="nav-a1" href="../html-article/index.html">
            <span>HTML</span>
          </a>
          <a class="nav-a2" href="../css-article/index.html">
            <span>CSS</span>
          </a>
          <a class="nav-a3" href="../JavaScript-article/index.html">
            <span>JavaScript</span>
          </a>
        </div>
        <div id="nav-right-bottom">
          <a class="nav-a4" href="../vue-article/index.html">
            <span>Vuejs</span>
          </a>
          <a class="nav-a5" href="../nodejs-article/index.html">
            <span>Nodejs</span>
          </a>
          <a class="nav-a6" href="../life-article/index.html">
            <span>生活趣事</span>
          </a>
        </div>
      </div>

      <h1>最新文章</h1>
      <ul>
        <li v-for="item in newArticleList" :key="item.id">
          <nuxt-link :to="`/article_detail/${item.id}`">{{item.title}}</nuxt-link>
        </li>
      </ul>

      <h1>友情链接</h1>
      <div id="youqing">
        <a href="https://www.w3cschool.cn/" target="_blank">w3cschool官网</a>
        <a href="https://cn.vuejs.org/" target="_blank">vue官网</a>
        <a href="https://www.runoob.com/" target="_blank">菜鸟教程</a>
        <a href="http://nodejs.cn/" target="_blank">node中文网</a>
        <a href="http://jquery.cuishifeng.cn/" target="_blank">jquery文档</a>
      </div>
    </div>-->
  </div>
</template>

<script>
import { httpGet } from "../../http/index";
export default {
  async asyncData({ params }) {
    let article_content_res = await httpGet("articlemd/" + params.id);
    let article_detail_res = await httpGet("article/" + params.id);
    if (
      article_content_res.data.meta.status === 200 &&
      article_detail_res.data.meta.status === 200
    ) {
      // article_detail_res.data[0].lowType = article_detail_res.data[0].type.toLowerCase();
      return {
        article_detail: article_detail_res.data.data,
        article_content: article_content_res.data.data
      };
    }
  },
  head() {
    return {
      title: "文章详情"
    };
  },
};
</script>

<style lang="less" scoped>
@import "../../assets/less/article_list.less";
@import "../../assets/less/article_detail.less";
</style>