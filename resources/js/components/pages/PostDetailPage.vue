<template>
  <section id="post-detail">
    <h2>Dettagli post</h2>
    <Loader v-if="isLoading && !post" />
    <PostCard v-else :post="post" />
  </section>
</template>

<script>
import PostCard from "../posts/PostCard.vue";
import Loader from "../Loader.vue";

export default {
  name: "PostDetailPage",
  components: {
    PostCard,
    Loader,
  },
  data() {
    return {
      post: null,
      isLoading: false,
    };
  },
  methods: {
    getPost() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/posts/" + this.$route.params.id)
        .then((res) => {
          this.post = res.data;
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