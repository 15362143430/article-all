<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script lang='ts'>
import { Component, Vue } from "vue-property-decorator";
import * as vuexSet from "./store/mutations-type";
@Component
export default class App extends Vue {
  created() {
    let role_id = sessionStorage.getItem("role_id");
    let role_name = sessionStorage.getItem("role_name");
    let position = sessionStorage.getItem("position");
    let name = sessionStorage.getItem("name");
    let avator = sessionStorage.getItem("avator");
    let email = sessionStorage.getItem("email");
    if (role_id) {
      this.$store.commit(vuexSet.setRoleID, role_id);
    }
    if (role_name) {
      this.$store.commit(vuexSet.setRoleName, role_name);
    }
    if (position) {
      this.$store.commit(vuexSet.setPosition, position);
    }
    if (email) {
       this.$store.commit(vuexSet.setEmail, email);
    }
    if (name) {
      this.$store.commit(vuexSet.setName, name);
    }
    if (avator) {
      this.$store.commit(vuexSet.setAvator, avator);
    }
  }
}
</script>

<style lang='less'>
</style>
