import {createWebHistory, createRouter} from "vue-router";
import CarrierCalculation from "../pages/CarrierCalculation.vue";


export const routes = [
    {
        name: 'carrier-calculation',
        path: '/',
        component: CarrierCalculation,
        props: {},
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
