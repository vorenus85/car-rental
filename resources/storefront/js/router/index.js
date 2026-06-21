import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@storefront/pages/HomePage.vue'
import ContactPage from '@storefront/pages/ContactPage.vue'
import FleetPage from '@storefront/pages/FleetPage.vue'
import DetailPage from '@storefront/pages/DetailPage.vue'
import ServicesPage from '@storefront/pages/ServicesPage.vue'
import NotFoundPage from '@storefront/pages/NotFoundPage.vue'

import { useMobileMenuStore } from '@storefront/stores/useMobileMenuStore'

const router = createRouter({
    history: createWebHistory(),
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        }

        return {
            top: 0,
            behavior: 'smooth',
        }
    },
    routes: [
        { path: '/:pathMatch(.*)*', name: 'notFound', component: NotFoundPage },
        { path: '/', name: 'home', component: HomePage },
        { path: '/contact', name: 'contact', component: ContactPage },
        { path: '/fleet', name: 'fleet', component: FleetPage },
        { path: '/car/:id', name: 'car', component: DetailPage },
        { path: '/services', name: 'services', component: ServicesPage },
    ],
})

// Register global navigation guard
router.beforeEach((to, from, next) => {
    const menuStore = useMobileMenuStore()
    menuStore.closeMenu() // Close mobile menu on every route change
    next()
})

export default router
