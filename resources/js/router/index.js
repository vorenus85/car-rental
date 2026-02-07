import { createRouter, createWebHistory } from 'vue-router'

import DashboardPage from '@/pages/DashboardPage.vue'
import BookingsPage from '@/pages/BookingsPage.vue'
import UnitsPage from '@/pages/UnitsPage.vue'
import CalendarPage from '@/pages/CalendarPage.vue'
import ClientsPage from '@/pages/ClientsPage.vue'
import SettingsPage from '@/pages/SettingsPage.vue'
import NotFoundPage from '@/pages/NotFoundPage.vue'
import LoginPage from '@/pages/LoginPage.vue'

import { useAuthStore } from '@/stores/auth'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/:pathMatch(.*)*', name: 'notFound', component: NotFoundPage },
        { path: '/', name: 'login', component: LoginPage },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: DashboardPage,
            meta: { requiresAuth: true },
        },

        {
            path: '/bookings',
            name: 'bookings',
            component: BookingsPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/units',
            name: 'units',
            component: UnitsPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/calendar',
            name: 'calendar',
            component: CalendarPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/clients',
            name: 'clients',
            component: ClientsPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/settings',
            name: 'settings',
            component: SettingsPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/logout',
            name: 'logout',
            meta: { requiresAuth: true },
        },
    ],
})

router.beforeEach(async to => {
    const auth = useAuthStore()

    if (to.meta.requiresAuth) {
        if (!auth.loaded) {
            await auth.fetchUser()
        }

        if (!auth.user?.id) {
            return { name: 'login' }
        }
    }

    if (to.name === 'login' && auth.user?.id) {
        return { name: 'dashboard' }
    }

    if (to.name === 'logout') {
        await auth.logout()
        return { name: 'login' }
    }
})

export default router
