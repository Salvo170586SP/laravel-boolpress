<template>
  <section class="my-5">
    <h2 class="mb-5">Lista Dei Post</h2>
    <Loader v-if="isLoading" />
    <div v-else>
      <div v-if="posts.length">
        <PostCard v-for="post in posts" :key="post.id" :post="post" />
      </div>
      <p v-else>Non ci sono post</p>
    </div>
  </section>
</template>

<script>
import PostCard from "./PostCard.vue";
import Loader from "../Loader.vue";
export default {
  name: "PostsList",
  components: {
    PostCard,
    Loader,
  },
  data() {
    return {
      posts: [],
      url: "http://localhost:8000/api/posts",
      isLoading: false,
    };
  },
  methods: {
    //CHIAMATA DELL API CON AXIOS
    getPosts() {
      this.isLoading = true;
      axios
        .get(this.url)
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          this.isLoading = false;
          console.log("chiamata terminata");
        });
    },
  },
  mounted() {
    //CHIAMO L'API
    this.getPosts();
  },
};
</script>

<style>
</style>