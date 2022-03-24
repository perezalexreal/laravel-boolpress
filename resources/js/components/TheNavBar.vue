<template>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">Laravel Boolpress</a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-bs-controls="navbarSupportedContent"
        aria-bs-expanded="false"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
          <li
            class="nav-item"
            v-for="route in routes"
            :key="route.path"
          >
            <router-link :to="!route.path ? '/' : route.path" class="nav-link">
              {{ route.meta.linkText }}
            </router-link>
          </li>
          <!-- <router-link
              class="nav-link"
              tag="div"
              :to="{
                name: 'contacts.index',
                query: { name: 'pippo', age: 30 },
              }"
              >Go to Foo</router-link
            > -->
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/login" v-if="!user">  Login </a>
            <a class="nav-link" href="/admin" v-else> Dashboard </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>

import router from "../router";
import axios from "axios";

export default {
  data() {
    return {
      routes: [],
      user:null,
    };
  },
  methods : {
    fecthUser() {
        axios.get("/api/user").then((resp) => {
            console.log(resp.data);
            this.user = resp.data;
            localStorage.setItem("user", JSON.stringify(resp.data));
            window.dispatchEvent(new CustomEvent("storedUserChanged"));
        })
        .catch((er) => {
            console.error("Utente non loggato");
            localStorage.removeItem("user");
            window.dispatchEvent(new CustomEvent("storedUserChanged"));
        })
    }  
  },
  mounted() {
    this.routes = this.$router.getRoutes().filter((route) => !!route.meta.linkText);
    this.fecthUser();
    console.log(this.routes);
  },
};
</script>

<style></style>
