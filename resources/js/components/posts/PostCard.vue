<template>
  <div class="card bg-dark my-4">
    <div class="card-header">{{ getDatePost }}</div>
    <div class="card-body bg-dark">
      <blockquote class="blockquote mb-0">
          <h3>{{post.title}}</h3>
        <p>{{ post.content }}</p>
        <footer class="blockquote-footer">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </footer>
      </blockquote>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostCard",
  props: ["post"],
  computed: {
      //COSTRUISCO LA DATA
      getDatePost(){
          const postDate = new Date(this.post.updated_at);
          let day = postDate.getDate();
          let month = postDate.getMonth();
          const year = postDate.getFullYear();
          const hours = postDate.getHours();
          const minutes = postDate.getMinutes();
          const seconds = postDate.getSeconds();
          return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
      }
  }
};
</script>

<style>
</style>