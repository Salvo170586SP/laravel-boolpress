<template>
  <section class="my-5">
      <h2 class="mb-5">Lista Dei Post</h2>

      
  </section>
</template>

<script>
export default {
    name: "PostsList",
    data(){
        return{
            posts: [],
        }
    },
    methods:{
        //chiamata dell API con axios
        getPosts(){
            axios.get("http://localhost:8000/api/posts").then((res)=>{
              this.posts = res.data;
            }).catch((err)=>{
                console.error(err);
            }).then(()=>{
                console.log('chiamata terminata');
            })
        }
    },
    mounted(){
        //chiamo l'API
        this.getPosts();
    }
}
</script>

<style>

</style>