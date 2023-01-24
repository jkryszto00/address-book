import { createWebHistory, createRouter } from "vue-router";

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
            },
            {
                name: 'AddressList',
                path: '/address/list',
                component: AddressList
            },
            {
                name: 'AddressAdd',
                path: '/address/add',
                component: AddressAdd
            },
            {
                name: 'AddressEdit',
                path: '/address/:id/edit',
                component: AddressEdit,
                props: true
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
