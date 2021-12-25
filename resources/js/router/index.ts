import {createWebHistory, createRouter} from "vue-router";
import Index from '../pages/Index.vue';

export const routes = [
    {
        name: 'index',
        path: '/',
        component: Index
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;