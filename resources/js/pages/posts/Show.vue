<template>
<div>
  <div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <!-- <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="link-secondary" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>
        <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
      </div> -->
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 link-secondary" href="#">Ultimo aggiornamento {{ formatDate(post.updated_at)}}</a>
      <span v-if="post.category">  Categoria {{ post.category.code}}</span>
    </nav>
  </div>
</div>

<main class="container">
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark" v-bind:style="{ backgroundImage: 'url(' + post.coverImg + ')' }">
    <div class="col-md-6 px-0">
      <h1 class="display-4 fst-italic">{{ post.title }}</h1>
    </div>
  </div>
<!-- Nei post della home -->
  <!-- <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Design</strong>
          <h3 class="mb-0">Post title</h3>
          <div class="mb-1 text-muted">Nov 11</div>
          <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

        </div>
      </div>
    </div>
  </div> -->

  <div class="row g-5">
    <div class="col-md-8">

      <article class="blog-post">
        <h2 class="blog-post-title"></h2>
        <p class="blog-post-meta">  {{ formatDate(post.created_at) }} da <a href="#">{{ post.user.name}}</a></p>

        <p class="content-post">{{ post.content }}</p>
        <hr>
      
      </article>



      <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary" href="/">Torna ai post</a>
      </nav>

    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">

          <p class="mb-0">Contatta l'autore : {{ post.user.email}}</p>
        </div>

        <div class="p-4">
          <!-- <h4 class="fst-italic">Altri post di {{ post.user.posts}}</h4>  Da chiedere -->
          <ol class="list-unstyled mb-0">
            <li v-for="post in post.user.posts" :key="post.user.id"><a href="#">March 2021</a></li>
          </ol>
        </div>

        <div class="p-4">
          <h4 class="fst-italic">Tags</h4>
          <ol class="list-unstyled" v-if="post.tags">
            <li v-for="tag in post.tags" :key="tag.slug"><a href="#">{{ tag.name }}</a></li>
          </ol>
          <ol class="list-unstyled" v-if="post.tags.length === 0">
            <li>Non ci sono tag per questo post </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

</main>

</div>
</template>

<script>
import axios from "axios";
import dayjs from "dayjs";

export default {
  data() {
    return {
      post: {},
    };
  },
  methods: {
    async fetchPost() {
      try {
        const resp = await axios.get("/api/posts/" + this.$route.params.post);

        this.post = resp.data;
      } catch (er) {
        this.$router.replace({name: "error"})
      }
    },
    formatDate(date) { // Formatta la data con il formato specificato
      console.log(date);
      return dayjs(date).format("DD/MM/YYYY HH:mm");
    },
  },
  mounted() {
    console.log(this.$route.params.post);
    this.fetchPost();
  },
};
</script>

<style lang="scss" scoped>


img {
  width: 100%;
  max-width: 500px;
}
// .content-post {
//   width: 100;
//   max-width: 300px !important;
// }
</style> 
