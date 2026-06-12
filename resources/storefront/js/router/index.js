import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@storefront/pages/HomePage.vue'
import AboutPage from '@storefront/pages/AboutPage.vue'
import ContactPage from '@storefront/pages/ContactPage.vue'
import FleetPage from '@storefront/pages/FleetPage.vue'
import ServicesPage from '@storefront/pages/ServicesPage.vue'
import NotFoundPage from '@storefront/pages/NotFoundPage.vue'

import { useMobileMenuStore } from '@storefront/stores/useMobileMenuStore'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/:pathMatch(.*)*', name: 'notFound', component: NotFoundPage },
        { path: '/', name: 'home', component: HomePage },
        { path: '/about-us', name: 'about-us', component: AboutPage },
        { path: '/contact', name: 'contact', component: ContactPage },
        { path: '/fleet', name: 'fleet', component: FleetPage },
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
