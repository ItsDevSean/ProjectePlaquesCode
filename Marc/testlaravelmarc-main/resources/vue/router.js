import { createWebHistory, createRouter } from "vue-router";
import ListComponent from "./ComponentsVue/ListComponent.vue";
import SaveComponent from "./ComponentsVue/SaveComponent.vue";

const routes = [
    {
        name: 'list',
        path: '/vue', 
        component: ListComponent
    },
    {
        name: 'save', 
        path: '/save', 
        component: SaveComponent
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;
