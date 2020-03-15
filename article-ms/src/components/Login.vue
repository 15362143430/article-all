<template>
  <div class="login_container">
    <div class="login_box" v-if="show">
      <!-- 头像区域 -->
      <div class="avatar_box">
        <img src="../assets/logo.png" alt />
      </div>
      <!-- 登录表单区域 -->
      <el-form
        ref="loginFormRef"
        :model="loginForm"
        :rules="loginFormRules"
        label-width="0px"
        class="login_form"
      >
        <el-form-item prop="username">
          <el-input v-model="loginForm.username" prefix-icon="el-icon-user"></el-input>
        </el-form-item>
        <el-form-item prop="password">
          <el-input v-model="loginForm.password" type="password" prefix-icon="el-icon-goods"></el-input>
        </el-form-item>
        <el-form-item class="btns">
          <el-button type="primary" @click="login()">登录</el-button>
          <el-button type="info" @click="resetLoginForm()">重置</el-button>
        </el-form-item>
      </el-form>
    </div>

    <div class="register_box" v-if="!show">
      <!-- 登录表单区域 -->
      <el-form
        ref="registerFormRef"
        :model="registerForm"
        :rules="registerFormRules"
        label-width="0px"
        class="register_form"
      >
        <el-form-item>
          <el-upload
            ref="addUpload"
            action="http://localhost:3001/article"
            :data="addForm"
            :file-list="fileList"
            :auto-upload="false"
            :limit="1"
            name="article_md"
            :on-success="uploadSuccess"
          >
            <el-button slot="trigger" size="small" type="primary">选取头像</el-button>
            <!-- <el-button
              style="margin-left: 10px;"
              size="small"
              type="success"
              @click="submitUpload"
            >上传到服务器</el-button>-->
            <div slot="tip" class="el-upload__tip">只能上传md文件</div>
          </el-upload>
        </el-form-item>
        <el-form-item prop="name">
          <el-input v-model="registerForm.name" prefix-icon="el-icon-user"></el-input>
        </el-form-item>
        <el-form-item prop="email">
          <el-input v-model="registerForm.email" prefix-icon="el-icon-user"></el-input>
        </el-form-item>
        <el-form-item prop="password">
          <el-input v-model="registerForm.password" type="password" prefix-icon="el-icon-goods"></el-input>
        </el-form-item>
        <el-form-item class="btns">
          <el-button type="primary" @click="register()">注册</el-button>
          <el-button type="info" @click="resetRegisterForm()">重置</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script lang='ts'>
import { Component, Prop, Vue } from "vue-property-decorator";
import { httpLogin, httpRegister } from "../http/index";
import * as vuexSet from "../store/mutations-type";

@Component
export default class Login extends Vue {
  private show: boolean = true;
  public loginForm = {
    username: "857287645@qq.com",
    password: "123456"
  };
  //   登录表单验证规则
  public loginFormRules = {
    username: [
      { required: true, message: "请输入用户名", trigger: "blur" },
      { min: 3, max: 20, message: "长度在3到10个字符之间", trigger: "blur" }
    ],
    password: [{ required: true, message: "请输入密码", trigger: "blur" }]
  };

  private resetLoginForm() {
    let ref: any = this.$refs.loginFormRef;
    ref.resetFields();
  }
  private async login() {
    let ref: any = this.$refs.loginFormRef;
    ref.validate(async (valid: any) => {
      if (!valid) {
        return;
      }
      const { data: res } = await httpLogin(this.loginForm);
      if (res.meta.status == 200) {
        // console.log('登录成功')
        this.$message.success("登录成功");
        sessionStorage.setItem("token", res.data.token);
        sessionStorage.setItem("name", res.data.name);
        sessionStorage.setItem("email", res.data.email);
        sessionStorage.setItem("role_id", res.data.role_id);
        sessionStorage.setItem("role_name", res.data.role_name);
        sessionStorage.setItem("position", res.data.position);
        sessionStorage.setItem("avator", res.data.avator);
        this.$store.commit(vuexSet.setRoleID, res.data.role_id);
        this.$store.commit(vuexSet.setRoleName, res.data.role_name);
        this.$store.commit(vuexSet.setAvator, res.data.avator);
        this.$store.commit(vuexSet.setPosition, res.data.position);
        this.$store.commit(vuexSet.setEmail, res.data.email);
        this.$store.commit(vuexSet.setName, res.data.name);
        this.$router.push("/home");
      } else {
        this.$message.error(res.meta.msg);
      }
    });
  }

  public registerForm = {
    username: "857287645@qq.com",
    password: "123456"
  };
  //   注册表单验证规则
  public registerFormRules = {
    username: [
      { required: true, message: "请输入用户名", trigger: "blur" },
      { min: 3, max: 20, message: "长度在3到10个字符之间", trigger: "blur" }
    ],
    password: [{ required: true, message: "请输入密码", trigger: "blur" }]
  };

  private resetRegisterForm() {
    let ref: any = this.$refs.registerFormRef;
    ref.resetFields();
  }
  private async register() {
    let ref: any = this.$refs.registerFormRef;
    ref.validate(async (valid: any) => {
      if (!valid) {
        return;
      }
      const { data: res } = await httpRegister(this.loginForm);
      if (res.meta.status == 200) {
        // console.log('登录成功')
        this.$message.success("登录成功");
        sessionStorage.setItem("token", res.data.token);
        sessionStorage.setItem("name", res.data.name);
        sessionStorage.setItem("email", res.data.email);
        sessionStorage.setItem("role_id", res.data.role_id);
        this.$store.commit(vuexSet.setRoleID, res.data.role_id);
        this.$router.push("/home");
      } else {
        this.$message.error(res.meta.msg);
      }
    });
  }
}
</script>

<!-- Add 'scoped' attribute to limit CSS to this component only -->
<style scoped lang='less'>
.login_container {
  background-color: #2b4b6b;
  height: 100%;

  .login_box,
  .register_box {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 450px;
    height: 300px;
    background-color: #fff;
    border-radius: 3px;

    .avatar_box {
      position: absolute;
      left: 50%;
      transform: translate(-50%, -50%);
      height: 130px;
      width: 130px;
      border: 1px solid #eee;
      border-radius: 50%;
      overflow: hidden;
      padding: 10px;
      box-shadow: 00 10px #ddd;
      background-color: #fff;

      img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #eee;
      }
    }
  }
}

.login_form,
.register_form {
  position: absolute;
  bottom: 0;
  width: 100%;
  box-sizing: border-box;
  padding: 0 20px;
}

.btns {
  display: flex;
  justify-content: flex-end;
}
</style>