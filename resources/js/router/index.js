import { createRouter, createWebHistory } from 'vue-router'

import DashboardPage from '@/pages/DashboardPage.vue'
import BookingsPage from '@/pages/BookingsPage.vue'
import CalendarPage from '@/pages/CalendarPage.vue'
import ClientsPage from '@/pages/ClientsPage.vue'
import SettingsPage from '@/pages/SettingsPage.vue'
import NotFoundPage from '@/pages/NotFoundPage.vue'
import LoginPage from '@/pages/LoginPage.vue'
import CarListPage from '@/pages/Car/ListPage.vue'
import CarCreatePage from '@/pages/Car/CreatePage.vue'
import CarEditPage from '@/pages/Car/EditPage.vue'
import BrandListPage from '@/pages/Brand/ListPage.vue'
import BrandCreatePage from '@/pages/Brand/CreatePage.vue'
import BrandEditPage from '@/pages/Brand/EditPage.vue'
import ModelListPage from '@/pages/Model/ListPage.vue'
import ModelCreatePage from '@/pages/Model/CreatePage.vue'
import ModelEditPage from '@/pages/Model/EditPage.vue'
import ColorListPage from '@/pages/Color/ListPage.vue'
import ColorCreatePage from '@/pages/Color/CreatePage.vue'
import ColorEditPage from '@/pages/Color/EditPage.vue'
import FeatureListPage from '@/pages/Feature/ListPage.vue'
import FeatureCreatePage from '@/pages/Feature/CreatePage.vue'
import FeatureEditPage from '@/pages/Feature/EditPage.vue'

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
            path: '/cars',
            name: 'cars',
            component: CarListPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/cars/create',
            name: 'cars.create',
            component: CarCreatePage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/cars/:id',
            name: 'cars.show',
            component: CarEditPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/brands',
            name: 'brands',
            component: BrandListPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/brands/create',
            name: 'brands.create',
            component: BrandCreatePage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/brands/:id',
            name: 'brands.show',
            component: BrandEditPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/models',
            name: 'models',
            component: ModelListPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/models/create',
            name: 'models.create',
            component: ModelCreatePage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/models/:id',
            name: 'models.show',
            component: ModelEditPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/colors',
            name: 'colors',
            component: ColorListPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/colors/create',
            name: 'colors.create',
            component: ColorCreatePage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/colors/:id',
            name: 'colors.show',
            component: ColorEditPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/features',
            name: 'features',
            component: FeatureListPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/features/create',
            name: 'features.create',
            component: FeatureCreatePage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/features/:id',
            name: 'features.show',
            component: FeatureEditPage,
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
