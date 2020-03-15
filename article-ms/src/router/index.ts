import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '../components/Login.vue';
import Home from '../components/Home.vue';
import Welecome from '../components/Welecome.vue';
// 文章
import Article from '../components/Article/Article.vue';
import ArticleType from '../components/Article/ArticleType.vue';
// 用户
import User from '../components/User/User.vue';
import UserPostition from '../components/User/UserPosition.vue';
// 权限
import Rights from '../components/Role/Rights.vue';
import Role from '../components/Role/Role.vue';
// 视频
import Video from '../components/Video/Video.vue';
import VideoType from '../components/Video/VideoType.vue';

Vue.use(VueRouter);

const routes: any = [
  // 重定向
  {
    path: '/',
    redirect: '/login',
  },
  {
    path: '/login',
    component: Login,
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: '', component: Welecome },
      { path: 'users', component: User },
      { path: 'userPosition', component: UserPostition },
      { path: 'articles', component: Article },
      { path: 'articlesType', component: ArticleType },
      { path: 'videos', component: Video },
      { path: 'videosType', component: VideoType },
      { path: 'rights', component: Rights },
      { path: 'roles', component: Role },
    ]
  }
];

const router = new VueRouter({
  // mode: 'hash',
  // base: process.env.BASE_URL,
  routes,
});

router.beforeEach((to, from, next) => {
  //    如果用户访问的是登录页直接放行
  if (to.path === "/login") {
    sessionStorage.clear();
    return next();
  }

  const token = sessionStorage.getItem("token");
  if (!token) {
    return next("/login");
  }

  next();

})

export default router;
