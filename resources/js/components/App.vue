<template>
  <div>
    <Header :title="title" />
    <main class="container my-4">
     <router-view></router-view>
    </main>
  </div>
</template>

<script>
import Header from "./Header.vue";
import PostsList from "./posts/PostsList.vue";
export default {
  name: "App",
  components: {
    Header,
    PostsList,
  },
  data(){
    return{
      title: "Boolpress",
    };
  }
};
</script>
