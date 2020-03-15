<template>
  <div class="container">
    <div id="content">
      <div id="lunbotu">
        <ul>
          <li id="list1" class="active">
            <nuxt-link to="/article_list/html">
              <img src="../assets/img/html.jpg" />
            </nuxt-link>
          </li>
          <li id="list2" class="active2">
            <nuxt-link to="/article_list/css">
              <img src="../assets/img/css.jpg" />
            </nuxt-link>
          </li>
          <li id="list3" class="active2">
            <nuxt-link to="/article_list/javascript">
              <img src="../assets/img/jvascript.jpg" />
            </nuxt-link>
          </li>
          <li id="list4" class="active2">
            <nuxt-link to="/article_list/vue">
              <img src="../assets/img/vue.jpg" />
            </nuxt-link>
          </li>
          <li id="list5" class="active2">
            <nuxt-link to="/article_list/nodejs">
              <img src="../assets/img/nodejs.jpg" />
            </nuxt-link>
          </li>
          <li id="list6" class="active2">
            <nuxt-link to="/article_list/life">
              <img src="../assets/img/life.jpg" />
            </nuxt-link>
          </li>
          <li id="list7" class="active2">
            <nuxt-link to="/article_list/php">
              <img src="../assets/img/php.jpg" />
            </nuxt-link>
          </li>
          <li id="list8" class="active2">
            <nuxt-link to="/article_list/linux">
              <img src="../assets/img/linux.jpg" />
            </nuxt-link>
          </li>
          <li id="list9" class="active2">
            <nuxt-link to="/video_study">
              <img src="../assets/img/book.jpg" />
            </nuxt-link>
          </li>
        </ul>
        <button id="prev" class="btn"><</button>
        <button id="next" class="btn">></button>
        <div id="blogger-msg">
          <div id="msg">
            <h3>个人信息</h3>
            <p>性别：男</p>
            <p>星座：处女座</p>
            <p>常住地：广东</p>
            <p>身高：300cm</p>
            <p>性格特点：乐观，积极向上</p>
          </div>
          <div id="hobbies">
            <h3>爱好与梦想</h3>
            <p>吃饭，吃面，吃好吃的</p>
            <p>敲代码，敲代码，敲代码</p>
            <p>喜欢帮助人</p>
            <p>喜欢女孩子</p>
            <p>梦想是有一天成为全栈攻城狮</p>
          </div>
        </div>
      </div>
      <div id="article">
        <div id="article-header">
          <p>最新文章</p>
          <span>
            <nuxt-link to="/article_list/html">技术分享({{newArticleList.total.tec}})</nuxt-link>
            <nuxt-link to="/article_list/life">生活趣事({{newArticleList.total.life}})</nuxt-link>
          </span>
        </div>
        <div id="article-body">
          <div class="article-content" v-for="item in newArticleList.list" :key="item.id">
            <img :src="item.img_path" />
            <ul>
              <h3>
                <nuxt-link :to="`/article_detail/${item.id}`">{{item.title}}</nuxt-link>
              </h3>
              <p class="neirong">{{item.body}}</p>
              <p>
                <span>
                  <i class="iconfont">&#xe64f;</i>
                  <a href="#" class="type">{{item.type}}</a>
                </span>
                <span>
                  <i class="iconfont">&#xe63b;</i>
                  <i class="date">{{item.addtime}}</i>
                </span>
              </p>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div id="catalog">
      <div id="blogger">
        <img src="../assets/img/blogger.png" />
        <p id="bloggerName">林三心</p>
        <p id="motto">我可是要成为全栈的男人啊！！！</p>
        <a href="https://weibo.com/u/5118965880/home?wvr=5" title="新浪微博" target="_blank">
          <i class="iconfont">&#xe66b;</i>
        </a>
        <a href="https://github.com/15362143430" title="github" target="_blank">
          <i class="iconfont">&#xe628;</i>
        </a>
        <a href="#" title="邮箱" target="_blank">
          <i class="iconfont">&#xe687;</i>
        </a>
      </div>

      <h1>最新文章</h1>
      <ul>
        <li v-for="item in newArticleList.list" :key="item.id">
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
        <a href="https://www.kancloud.cn/manual/thinkphp5/118003" target="_blank">ThinkPHP文档</a>
        <a href="https://www.csdn.net/" target="_blank">CSDN</a>
      </div>
    </div>
  </div>
</template>

<script>
import { httpGet } from "../http/index";
export default {
  async asyncData() {
    let {data:res} = await httpGet("articles/1/5");
    if (res.meta.status === 200) {
      return { newArticleList: res.data };
    }
  },
  mounted() {
    this.lunbotu();
  },
  data() {
    return {
      typeImgList:{
        "HTML":"http://47.100.137.31/img/html2.png",
        "CSS":"http://47.100.137.31/img/css2.png",
        "JavaScript":"http://47.100.137.31/img/javascript2.png",
        "Vue":"http://47.100.137.31/img/vue2.png",
        "Nodejs":"http://47.100.137.31/img/nodejs.jpg",
        "生活趣事":"http://47.100.137.31/img/life2.png",
        "书籍推荐":"http://47.100.137.31/img/book2.png"
      }
    };
  },
  head() {
    return {
      title: "首页"
    };
  },
  methods: {
    lunbotu() {
      var i = 0;
      var li = document.getElementById("lunbotu").getElementsByTagName("li");
      document.getElementById("prev").onclick = function() {
        for (var j = 0; j < li.length; j++) {
          li[j].className = "active2";
        }
        i--;
        if (i < 0) {
          i = 6;
          li[i].className = "active";
        } else {
          li[i].className = "active";
        }
      };

      var timer = setInterval(function() {
        for (var j = 0; j < li.length; j++) {
          li[j].className = "active2";
        }
        i++;
        if (i > 6) {
          i = 0;
          li[i].className = "active";
        } else {
          li[i].className = "active";
        }
      }, 2000);

      document.getElementById("next").onclick = function() {
        for (var j = 0; j < li.length; j++) {
          li[j].className = "active2";
        }
        i++;
        if (i > 6) {
          i = 0;
          li[i].className = "active";
        } else {
          li[i].className = "active";
        }
      };

      document.getElementById("lunbotu").onmouseenter = function() {
        clearInterval(timer);
      };
      document.getElementById("lunbotu").onmouseleave = function() {
        timer = setInterval(function() {
          for (var j = 0; j < li.length; j++) {
            li[j].className = "active2";
          }
          i++;
          if (i > 6) {
            i = 0;
            li[i].className = "active";
          } else {
            li[i].className = "active";
          }
        }, 2000);
      };
    }
  }
};
</script>

<style lang="less" scoped>
@import "../assets/less/lunbotu.less";
@import "../assets/less/index.less";
</style>
