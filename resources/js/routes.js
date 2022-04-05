import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import HomePage from './components/pages/HomePage.vue';
import PostDetailPage from './components/pages/PostDetailPage.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/posts/:id', component: PostDetailPage, name: 'post-detail' },
    ]

})

export default router;