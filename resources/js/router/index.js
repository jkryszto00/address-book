import { createWebHistory, createRouter } from "vue-router";
import store from "../store";

const Index = () => import('@/pages/Index.vue');

/* Guest */
const Login = () => import('@/pages/Auth/Login.vue');
const Register = () => import('@/pages/Auth/Register.vue');

/* Address */
const AddressList = () => import('@/pages/Address/List.vue');
const AddressAdd = () => import('@/pages/Address/Add.vue');
const AddressEdit = () => import('@/pages/Address/Edit.vue');

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
                component: Login,
                meta: { requiresAuth: false }
            },
            {
                name: 'Register',
                path: '/register',
                component: Register,
                meta: { requiresAuth: false }
            },
            {
                name: 'Index',
                path: '/',
                component: Index,
                meta: { requiresAuth: false }
            },
            {
                name: 'AddressList',
                path: '/address/list',
                component: AddressList,
                meta: { requiresAuth: true }
            },
            {
                name: 'AddressAdd',
                path: '/address/add',
                component: AddressAdd,
                meta: { requiresAuth: true }
            },
            {
                name: 'AddressEdit',
                path: '/address/:id/edit',
                component: AddressEdit,
                props: true,
                meta: { requiresAuth: true }
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters["auth/authenticated"]) {
            next({ path: '/login' })
        }

        next()
    }

    next()
})

export default router
