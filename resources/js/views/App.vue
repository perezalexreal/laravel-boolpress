<template>
  <div>

<TheNavBar></TheNavBar>
    <div class="container py-4">
      <router-view></router-view>
    </div>
    <TheFooter></TheFooter>
  </div>
</template>

<script>

import TheFooter from "../components/TheFooter.vue";
import TheNavBar from '../components/TheNavBar.vue';
export default {
  components: {  TheFooter, TheNavBar },
};
</script>

<style></style>