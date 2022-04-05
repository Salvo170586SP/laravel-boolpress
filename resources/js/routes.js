import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import HomePage from './components/pages/HomePage.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: HomePage }
    ]

})

export default router;