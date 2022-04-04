<template>
  <section class="my-5">
      <h2 class="mb-5">Lista Dei Post</h2>

      <ul v-for="post in posts" :key="post.id">
          <li>{{ post.title }}</li>
      </ul>
  </section>
</template>

<script>
export default {
    name: "PostsList",
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