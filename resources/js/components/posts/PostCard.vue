<template>
  <div class="card bg-dark my-4">
    <div class="card-header"></div>
    <div class="card-body bg-dark">
      <blockquote class="blockquote mb-0">
          <h3>{{post.title}}</h3>
        <p>{{ post.content }}</p>
        <footer class="blockquote-footer">
          {{ post.updated_at }} <cite title="Source Title">Source Title</cite>
        </footer>
      </blockquote>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostCard",
  props: ["post"],
};
</script>

<style>
</style>