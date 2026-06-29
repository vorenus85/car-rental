import { createRouter, createWebHistory } from 'vue-router'

import DashboardPage from '@admin/pages/DashboardPage.vue'

import BookingsPage from '@admin/pages/BookingsPage.vue'

import CalendarPage from '@admin/pages/CalendarPage.vue'

import ClientsPage from '@admin/pages/ClientsPage.vue'

import SettingsPage from '@admin/pages/SettingsPage.vue'
import NotFoundPage from '@admin/pages/NotFoundPage.vue'

import ForgotPasswordPage from '@admin/pages/Auth/ForgotPasswordPage.vue'
import ResetPasswordPage from '@admin/pages/Auth/ResetPasswordPage.vue'
import LoginPage from '@admin/pages/Auth/LoginPage.vue'

import CarListPage from '@admin/pages/Car/ListPage.vue'
import CarCreatePage from '@admin/pages/Car/CreatePage.vue'
import CarEditPage from '@admin/pages/Car/EditPage.vue'

import LocationListPage from '@admin/pages/Location/ListPage.vue'
import LocationCreatePage from '@admin/pages/Location/CreatePage.vue'
import LocationEditPage from '@admin/pages/Location/EditPage.vue'

import BrandListPage from '@admin/pages/Brand/ListPage.vue'
import BrandCreatePage from '@admin/pages/Brand/CreatePage.vue'
import BrandEditPage from '@admin/pages/Brand/EditPage.vue'

import CarModelListPage from '@admin/pages/CarModel/ListPage.vue'
import CarModelCreatePage from '@admin/pages/CarModel/CreatePage.vue'
import CarModelEditPage from '@admin/pages/CarModel/EditPage.vue'

import VariantListPage from '@admin/pages/Variant/ListPage.vue'
import VariantCreatePage from '@admin/pages/Variant/CreatePage.vue'
import VariantEditPage from '@admin/pages/Variant/EditPage.vue'

import FeatureListPage from '@admin/pages/Feature/ListPage.vue'
import FeatureCreatePage from '@admin/pages/Feature/CreatePage.vue'
import FeatureEditPage from '@admin/pages/Feature/EditPage.vue'

import AcountProfilePage from '@admin/pages/Account/ProfilePage.vue'
import AccountPasswordPage from '@admin/pages/Account/PasswordPage.vue'

import UserListPage from '@admin/pages/User/ListPage.vue'
import UserCreatePage from '@admin/pages/User/CreatePage.vue'
import UserEditPage from '@admin/pages/User/EditPage.vue'

import { useAuthStore } from '@admin/stores/auth'

const router = createRouter({
    history: createWebHistory('/admin'),
    routes: [
        { path: '/:pathMatch(.*)*', name: 'notFound', component: NotFoundPage },
        { path: '/', name: 'login', component: LoginPage },
        { path: '/forgot-password', name: 'forgot-password', component: ForgotPasswordPage },
        { path: '/reset-password', name: 'reset-password', component: ResetPasswordPage },
        {
            path: '/settings/users',
            name: 'users',
            component: UserListPage,
            meta: {
                requiresAuth: true,
                parent: 'settings',
            },
        },
        {
            path: '/settings/users/create',
            name: 'users.create',
            component: UserCreatePage,
            meta: {
                requiresAuth: true,
                parent: 'settings',
            },
        },
        {
            path: '/settings/users/:id',
            name: 'users.show',
            component: UserEditPage,
            meta: {
                requiresAuth: true,
                parent: 'settings',
            },
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: DashboardPage,
            meta: { requiresAuth: true },
        },

        {
            path: '/account',
            name: 'account',
            redirect: () => {
                return { path: '/account/profile' }
            },
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/account/profile',
            name: 'profile',
            component: AcountProfilePage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/account/password',
            name: 'password',
            component: AccountPasswordPage,
            meta: {
                requiresAuth: true,
            },
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
            path: '/fleet/cars',
            name: 'cars',
            component: CarListPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/cars/create',
            name: 'cars.create',
            component: CarCreatePage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/cars/:id',
            name: 'cars.show',
            component: CarEditPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/locations',
            name: 'locations',
            component: LocationListPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/locations/create',
            name: 'locations.create',
            component: LocationCreatePage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/locations/:id',
            name: 'locations.show',
            component: LocationEditPage,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/fleet/brands',
            name: 'brands',
            component: BrandListPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/brands/create',
            name: 'brands.create',
            component: BrandCreatePage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/brands/:id',
            name: 'brands.show',
            component: BrandEditPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/models',
            name: 'models',
            component: CarModelListPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/models/create',
            name: 'models.create',
            component: CarModelCreatePage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/models/:id',
            name: 'models.show',
            component: CarModelEditPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/variants',
            name: 'variants',
            component: VariantListPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/variants/create',
            name: 'variants.create',
            component: VariantCreatePage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/variants/:id',
            name: 'variants.show',
            component: VariantEditPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/features',
            name: 'features',
            component: FeatureListPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/features/create',
            name: 'features.create',
            component: FeatureCreatePage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
            },
        },
        {
            path: '/fleet/features/:id',
            name: 'features.show',
            component: FeatureEditPage,
            meta: {
                requiresAuth: true,
                parent: 'fleet',
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
            await auth.getUser()
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
