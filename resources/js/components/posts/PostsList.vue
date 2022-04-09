<template>
  <section class="my-5">
    <div class="d-flex align-items-center justify-content-between">
      <h2>Lista Dei Post</h2>
      <SelectorOptions
        id="category-filter"
        label-text="seleziona categoria"
        default-option="Tutte le categorie"
        default-value=""
        option-text="label"
        option-value="id"
        :options="categories"
        @filter-change="filterCategory"
      />
    </div>

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
import SelectorOptions from "../SelectorOptions.vue";
export default {
  name: "PostsList",
  components: {
    PostCard,
    Loader,
    SelectorOptions,
  },
  data() {
    return {
      posts: [],
      urlPosts: "http://localhost:8000/api/posts",
      urlCategories: "http://localhost:8000/api/categories",
      isLoading: false,
      categories: [],
      selectedCategory: null,
    };
  },
  methods: {
    filterCategory(selectedValue) {
      this.selectedCategory = selectedValue;
      this.getPosts();
    },

    //CHIAMATA DELLE API DELLE CATEGORIE
    getCategories() {
      this.isLoading = true;
      axios
        .get(this.urlCategories)
        .then((res) => {
          this.categories = res.data;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          this.isLoading = false;
          console.log("chiamata terminata");
        });
    },

    //CHIAMATA DELLE API DEI POST
    getPosts() {
      this.isLoading = true;

      //costruisco la string del category_id da montare alla url 
      const queryString = {
        params: {
            category_id: this.selectedCategory,
        }
      }
  
      axios
        .get(this.urlPosts, queryString)
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
    //RICHIAMO L'API IN PAGINA
    this.getPosts();
    this.getCategories();
  },
};
</script>

<style>
</style>