import { createWebHistory, createRouter } from "vue-router";

/* Guest */
const Login = () => import('@/pages/Auth/Login.vue');
const Register = () => import('@/pages/Auth/Register.vue');
const Index = () => import('@/pages/Index.vue');
/* Layout */
const DefaultLayout = () => import('@/layouts/Default.vue')

const routes = [
    {
        path: '/',
        component: DefaultLayout,
        children: [
            {
                name: 'Login',
                path: '/login',
                component: Login
            },
            {
                name: 'Register',
                path: '/register',
                component: Register
            },
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
