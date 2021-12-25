import {createWebHistory, createRouter} from "vue-router";
import Index from '../pages/Index.vue';
import Login from '../pages/Login.vue';

export const routes = [
    {
        name: 'index',
        path: '/',
        component: Index
    },
    {
        name: 'login_page',
        path: '/login_page',
        component: Login
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;