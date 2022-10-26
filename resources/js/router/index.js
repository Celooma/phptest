import { createRouter , createWebHistory } from 'vue-router';
import NotFound from '../pages/NotFound.vue';
import LoginPage from '../pages/LoginPage.vue';
import AdminPage from '../pages/AdminPage.vue';
import ApplyLeavePage from '../pages/ApplyLeavePage.vue'

const routes = [
    {
        path: '/',
        component: LoginPage
    },
    {
        path: '/login',
        component: LoginPage
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    },
    {
        path: '/admin',
        component: AdminPage
    },
    {
        path: '/apply',
        component: ApplyLeavePage
    },
]


const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
})

export default router;
