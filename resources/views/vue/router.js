import { createRouter, createWebHistory } from "vue-router";
import List from "../views/vue/ComponentsVue/ListComponent.vue";

const routes = [
    {
        name: 'list',
        path: '/vue', 
        component: List
    },
    
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;
