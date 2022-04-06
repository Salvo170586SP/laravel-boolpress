import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import HomePage from './components/pages/HomePage.vue';
import PostDetailPage from './components/pages/PostDetailPage.vue';
import ContactPage from './components/pages/ContactPage.vue';
import NotFoundPage from './components/pages/NotFoundPage.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/contact', component: ContactPage, name: 'contact' },
        { path: '/posts/:slug', component: PostDetailPage, name: 'post-detail' },
        { path: '*', component: NotFoundPage},
    ]

})

export default router;