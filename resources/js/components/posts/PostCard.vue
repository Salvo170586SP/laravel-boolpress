<template>
  <div class="card bg-dark my-4">
    <div class="p-3 d-flex justify-content-between align-items-center">
      <div>{{ getDatePost }}</div>
      <div>
        <router-link
          v-if="!hydeLink"
          class="btn btn-sm btn-primary"
          :to="{ name: 'post-detail', params: { slug: post.slug } }"
          >Scopri dettagli</router-link
        >
      <router-link v-else class="btn btn-sm btn-primary" :to="{name: 'home'}">Ritorna alla home</router-link>
      </div>
    </div>
    <div class="card-body bg-dark">
      <blockquote class="blockquote mb-0">
        <h3>{{ post.title }}</h3>
        <p>{{ post.content }}</p>
        <footer
          class="card-footer d-flex justify-content-between align-items-center"
        >
          <span v-if="post.category"  :class="`badge badge-pill badge-${post.category.color}`">{{
            post.category.label }}</span>

          <div>
            <span
              v-for="tag in post.tags"
              :key="tag.id"
              class="badge badge-pill"
              :style="`background-color: ${tag.color}`"
              >{{ tag.label }}</span
            >
          </div>
        </footer>
      </blockquote>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostCard",
  props: ["post", "hyde-link"],
  computed: {
    //COSTRUISCO LA DATA
    getDatePost() {
      const postDate = new Date(this.post.updated_at);
      let day = postDate.getDate();
      let month = postDate.getMonth();
      const year = postDate.getFullYear();
      const hours = postDate.getHours();
      const minutes = postDate.getMinutes();
      const seconds = postDate.getSeconds();
      return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    },
  },
};
</script>

<style>
</style>