<template>
  <el-container class="home_container">
    <el-header>
      <div>
        <img height="50" src="../assets/img/blogger.png" alt />
        <img height="50" src="../assets/img/logo.png" alt />
        <!-- <span>SunshineI后台管理系统</span> -->
      </div>
      <!-- <el-button type="primary" @click="exit()">退出</el-button> -->
      <el-menu mode="horizontal" active-text-color="rgb(255, 100, 40)">
        <el-menu-item index="1">
          <el-tooltip class="item" effect="dark" content="访问Github" placement="bottom">
            <a href="https://github.com/15362143430" target="_blank">
              <i class="iconfont">&#xe732;</i>
            </a>
          </el-tooltip>
        </el-menu-item>
        <el-menu-item index="2">
          <el-popover placement="bottom" width="150" trigger="hover">
            <img height="150" src="../assets/img/qq.png" alt />
            <i class="iconfont" slot="reference">&#xe6ca;</i>
          </el-popover>
        </el-menu-item>
        <el-menu-item index="3">
          <el-popover placement="bottom" width="150" trigger="hover">
            <img height="150" src="../assets/img/weixin.png" alt />
            <i class="iconfont" slot="reference">&#xe73b;</i>
          </el-popover>
        </el-menu-item>
        <el-submenu index="4">
          <template slot="title">
            欢迎您，
            <span id="name">{{$store.state.name}}</span>
          </template>
          <el-menu-item index="4-1">个人信息</el-menu-item>
          <el-menu-item index="4-2">修改信息</el-menu-item>
          <el-menu-item index="4-3" @click="exit()">注销账号</el-menu-item>
        </el-submenu>
      </el-menu>
    </el-header>
    <el-container ref="homePage">
      <el-aside :width="is_collapse?'64px':'200px'">
        <el-menu
          :default-active="nav"
          router
          :collapse-transition="false"
          :collapse="is_collapse"
          :unique-opened="true"
          background-color="#ffffff"
          text-color="rgb(102, 102, 102)"
          active-text-color="rgb(255, 100, 40)"
        >
          <el-menu-item index='/home'>
            <i class="el-icon-s-grid"></i>
            <span slot="title">首页</span>
          </el-menu-item>

          <el-submenu :index="item.id+''" v-for="item in menuList" :key="item.id">
            <template slot="title">
              <i :class="item.icon"></i>
              <span>{{item.auth_name}}</span>
            </template>
            <el-menu-item
              @click="saveNav(up_item.path)"
              v-for="up_item in item.children"
              :key="up_item.id"
              :index="up_item.path"
            >
              <template slot="title">
                <i :class="up_item.icon"></i>
                <span>{{up_item.auth_name}}</span>
              </template>
            </el-menu-item>
          </el-submenu>
        </el-menu>
      </el-aside>
      <el-main>
        <div class="toggle-button" @click="toggleCollapse()" v-html="is_collapse?'|||':'三'"></div>
        <router-view></router-view>
      </el-main>
    </el-container>
  </el-container>
</template>


<script lang='ts'>
import { Component, Prop, Vue, Watch } from "vue-property-decorator";
import { httpGET } from "../http/index";
import { setRoleID } from "../store/mutations-type";

@Component
export default class Home extends Vue {
  private menuList: any[] = [];
  private icon: any = {
    1: "el-icon-user",
    2: "el-icon-open",
    3: "el-icon-shopping-bag-1",
    4: "el-icon-document-copy",
    5: "el-icon-s-data"
  };
  private is_collapse: boolean = false;
  private nav: any = "";
  clientHeight: any;

  created() {
    this.getMenuList();
    this.nav = sessionStorage.getItem("nav");
  }
  mounted() {
    // 获取浏览器可视区域高度
    this.clientHeight = `${document.documentElement.clientHeight}`;
    // window.onresize = function temp() {
    //   this.clientHeight = `${document.documentElement.clientHeight}`;
    // };
  }

  // 监听预览窗口
  @Watch("clientHeight")
  getPreviewDialogVisible() {
    this.changeFixed(this.clientHeight);
  }

  changeFixed(clientHeight: any) {
    //动态修改样式
    let refs: any = this.$refs;
    refs.homePage.$el.style.height = clientHeight - 20 + "px";
  }

  //获取左侧菜单
  private async getMenuList() {
    const { data: res } = await httpGET("menus");
    console.log(res);
    if (res.meta.status == 200) {
      this.menuList = res.data;
    } else {
      this.$message.error(res.meta.msg);
    }
  }

  private exit() {
    this.$confirm("此操作将退出账号, 是否继续?", "提示", {
      confirmButtonText: "确定",
      cancelButtonText: "取消",
      type: "warning"
    })
      .then(() => {
        sessionStorage.clear();
        this.$router.push("/login");
        this.$message({
          type: "success",
          message: "账号注销成功"
        });
      })
      .catch(() => {
        this.$message({
          type: "info",
          message: "已取消注销"
        });
      });
  }

  //点击按钮切换
  private toggleCollapse() {
    this.is_collapse = !this.is_collapse;
  }
  private saveNav(path: string) {
    sessionStorage.setItem("nav", path);
  }
}
</script>


<style lang='less' scoped>
.el-header {
  background-color: #ffffff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-left: 0;
  color: rgb(102, 102, 102);
  font-size: 20px;
  border-bottom: 5px solid #eaedf1;
  box-sizing: content-box;
  > div {
    display: flex;
    align-items: center;
    margin-left: 20px;
    > img {
      border-radius: 50%;
    }
    > span {
      padding-left: 15px;
    }
  }
  i {
    font-size: 16px;
  }
}
.el-aside {
  background-color: #ffffff;
  .el-menu {
    border: none;
  }
}
.el-main {
  background-color: #eaedf1;
  // overflow: scroll;
  .toggle-button {
    background-color: #ffffff;
    text-align: left;
    height: 24px;
    line-height: 24px;
    color: rgb(102, 102, 102);
    letter-spacing: 0.2em;
    cursor: pointer;
    border: 2px solid #eaedf1;
    background-color: #ffffff;
    margin-bottom: 5px;
    // width: 100%;
  }
}
.home_container {
  height: 100%;
}
.el-popover {
  position: relative;
  img {
    margin: 0 auto;
  }
}
#name {
  color: rgb(169, 216, 110);
}
</style>