<template>
  <footer class="border-top bg-light py-5">
    <div class="container">
      <h6>The footer</h6>
      <h3 v-if="user"> Ciao, {{ user.name }}</h3>
    </div>

    
  </footer>
</template>

<script>
export default {
    data(){
        return {
            user: null,
        }
    },
    computed: {
        storedUser(){
            return localStorage.getItem("user");
        }
    },
    methods:  {
        getStoredUser() {
            var storedUser = localStorage.getItem("user");
            if(storedUser) {
                this.user = JSON.parse(storedUser);
            } else {
            this.user = null;
            }
        }
    },
    mounted() {
        this.getStoredUser();
        window.addEventListener("storedUserChanged", ()  => {
             this.getStoredUser();
        })
    },
    // watch: {

    // }
};
</script>

<style></style>
