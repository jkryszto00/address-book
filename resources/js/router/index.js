import { createWebHistory, createRouter } from "vue-router";

/* Guest */
const Index = () => import('@/pages/Index.vue');
/* Layout */
const DefaultLayout = () => import('@/layouts/Default.vue')

const routes = [
    {
        path: '/',
        component: DefaultLayout,
        children: [
            {
                name: 'Index',
                path: '/',
                component: Index,
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
