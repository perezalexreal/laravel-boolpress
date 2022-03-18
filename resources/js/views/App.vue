<template>
  <div>
      <h1> Ecco vue.js insieme a Laravel </h1>


      <div class="container py-4 text-center">
          <h1>Vue Fronten</h1>
                <a href="/login">login</a>

                <ul>
                  <li v-for="post in posts" :key="post.slug">
                       {{ post.slug }}
                  </li>
                </ul>
      <a href="/register">Register</a>
      </div>
  </div>
</template>

<script>

import axios from "axios";

export default {
    data(){
        return{
            posts : []
        }
    },
    methods: {
         fetchPosts(){
            axios.get("/api/posts")
            .then(resp => {
                this.posts = resp.data;
                console.log(resp.data);
            })
        }
    },
    mounted(){
        this.fetchPosts();
    }

}
</script>

<style lang="scss" scoped>


div {
    h1 {
        text-align: center;
    }
}

</style>