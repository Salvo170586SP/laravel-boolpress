<template>
  <section class="my-5">
      <h2 class="mb-5">Lista Dei Post</h2>
        <PostCard v-for="post in posts" :key="post.id" :post="post"/>
  </section>
</template>

<script>
import PostCard from './PostCard.vue';
export default {
    name: "PostsList",
    components: {
        PostCard,
    },
    data(){
        return{
            posts: [],
            url: "http://localhost:8000/api/posts",
        }
    },
    methods:{
        //CHIAMATA DELL API CON AXIOS
        getPosts(){
            axios.get(this.url).then((res)=>{
              this.posts = res.data;
            }).catch((err)=>{
                console.error(err);
            }).then(()=>{
                console.log('chiamata terminata');
            })
        }
    },
    mounted(){
        //CHIAMO L'API
        this.getPosts();
    }
}
</script>

<style>

</style>