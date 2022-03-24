<template>
  <div>
    <h1>Ultimi post del blog</h1>

    <nav class="bg-light my-3 d-flex justify-content-end">
      <button
        class="btn btn-outline-primary"
        @click="fetchPosts(pagination.current_page)"
      >
        <i class="fas fa-redo me-2"></i>Ricarica dati
      </button>
    </nav>

<div class="spinner-border d-flex m-auto " role="status" v-if="loading" >
  <span class="sr-only ">Loading...</span>
</div>



    <!-- I card dei post vengono caricati qui -->
    <div class="row row-cols-1 row-cols-md-2 g-4" v-if="!loading">
      <PostCard v-for="post of posts" :key="post.id" :post="post"> </PostCard>
    </div>

    <nav
      aria-label="Page navigation example"
      class="d-flex justify-content-center my-5"
    >
      <ul class="pagination m-0">
        <li
          class="page-item"
          :class="{ disabled: pagination.current_page === 1 }"
        >
          <a class="page-link" @click="fetchPosts(pagination.current_page - 1)"
            >Previous</a
          >
        </li>
        <!-- <li class="page-item">
            {{ pagination.current_page }} su {{ pagination.last_page }}
          </li> -->
        <li
          class="page-item"
          :class="{ active: pagination.current_page === page }"
          v-for="page in pagination.last_page"
          :key="page"
        >
          <a class="page-link" @click="fetchPosts(page)">{{ page }}</a>
        </li>
        <li
          class="page-item"
          :class="{
            disabled: pagination.current_page === pagination.last_page,
          }"
        >
          <a class="page-link" @click="fetchPosts(pagination.current_page + 1)"
            >Next</a
          >
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import axios from "axios";
import PostCard from "../components/PostCard.vue";

export default {
  components: { PostCard },
  data() {
    return {
      posts: [],
      pagination: {},
      loading: true,
    };
  },
  methods: {
    async fetchPosts(page = 1) {
      this.posts = [];
      if (page < 1) {
        page = 1;
      }

      if (page > this.pagination.last_page) {
        page = this.pagination.last_page;
      }

      /* axios.get("/api/posts").then((resp) => {
        this.posts = resp.data;
      }); */

      this.loading = true;

      try {
        const resp = await axios.get("/api/posts?page=" + page);
        this.pagination = resp.data;
        this.posts = resp.data.data;
      } catch (er) {
        console.log(er);
      } finally {
        setTimeout(() => {
          this.loading = false;
        }, 1000);
      }
    },
  },
  mounted() {
    this.fetchPosts();
  },
};
</script>

<style></style>
