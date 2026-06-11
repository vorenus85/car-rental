import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@storefront/pages/HomePage.vue'
import NotFoundPage from '@storefront/pages/NotFoundPage.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/:pathMatch(.*)*', name: 'notFound', component: NotFoundPage },
        { path: '/', name: 'home', component: HomePage },
    ],
})

export default router
