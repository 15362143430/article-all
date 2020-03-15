import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import axios from 'axios';
Vue.prototype.$axios = axios;
Vue.config.productionTip = false;

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.prototype.$message = ElementUI.Message;
Vue.use(ElementUI);

import echarts from 'echarts';
Vue.prototype.$echarts = echarts

// 引入全局样式
import './assets/less/global.less';
import './assets/less/icon.less';

import Breadcrumb from './components/Common/Breadcrumb.vue';
Vue.component('Breadcrumb',Breadcrumb);

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount('#app');
