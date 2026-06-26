import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@storefront/pages/HomePage.vue'
import ContactPage from '@storefront/pages/ContactPage.vue'

import LoginPage from '@storefront/pages/Auth/LoginPage.vue'
import RegisterPage from '@storefront/pages/Auth/RegisterPage.vue'
import ForgotPasswordPage from '@storefront/pages/Auth/ForgotPasswordPage.vue'
import ResetPasswordPage from '@storefront/pages/Auth/ResetPasswordPage.vue'

import FleetPage from '@storefront/pages/FleetPage.vue'
import DetailPage from '@storefront/pages/DetailPage.vue'
import ServicesPage from '@storefront/pages/ServicesPage.vue'
import NotFoundPage from '@storefront/pages/NotFoundPage.vue'

import { useMobileMenuStore } from '@storefront/stores/mobileMenuStore'
import { useAuthStore } from '@storefront/stores/authStore'

const router = createRouter({
    history: createWebHistory(),
    /*
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        }

        return {
            top: 0,
            behavior: 'smooth',
        }
    },
    */
    routes: [
        { path: '/:pathMatch(.*)*', name: 'notFound', component: NotFoundPage },
        { path: '/', name: 'home', component: HomePage },

        { path: '/login', name: 'login', component: LoginPage },
        { path: '/register', name: 'register', component: RegisterPage },
        { path: '/forgot-password', name: 'forgot-password', component: ForgotPasswordPage },
        { path: '/reset-password', name: 'reset-password', component: ResetPasswordPage },
        {
            path: '/logout',
            name: 'logout',
            meta: { requiresAuth: true },
        },
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

router.beforeEach(async to => {
    const auth = useAuthStore()

    if (to.meta.requiresAuth) {
        if (!auth.loaded) {
            await auth.fetchUser()
        }

        if (!auth.user?.id) {
            return { name: 'home' }
        }
    }

    if (to.name === 'login' && auth.user?.id) {
        return { name: 'home' }
    }

    if (to.name === 'logout') {
        await auth.logout()
        return { name: 'home' }
    }
})

export default router
