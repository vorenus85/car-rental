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

import DriverInfoPage from '@storefront/pages/Booking/DriverInfoPage.vue'
import ExtrasInsurancePage from '@storefront/pages/Booking/ExtrasInsurancePage.vue'
import PaymentPage from '@storefront/pages/Booking/PaymentPage.vue'

import SuccessPage from '@storefront/pages/Booking/SuccessPage.vue'
import FailurePage from '@storefront/pages/Booking/FailurePage.vue'

import PrivacyPolicyPage from '@storefront/pages/Support/PrivacyPolicyPage.vue'
import TermsConditionsPage from '@storefront/pages/Support/TermsConditionsPage.vue'
import CookiePolicyPage from '@storefront/pages/Support/CookiePolicyPage.vue'
import RefundCancellationPolicyPage from '@storefront/pages/Support/RefundCancellationPolicyPage.vue'
import RentalRequirementsPage from '@storefront/pages/Support/RentalRequirementsPage.vue'

import ProfileBasicDetailsPage from '@storefront/pages/Profile/BasicDetailsPage.vue'

import FaqPage from '@storefront/pages/FaqPage.vue'

import { useMobileMenuStore } from '@storefront/stores/mobileMenuStore'
import { useAuthStore } from '@storefront/stores/authStore'
import { useBookingStore } from '@storefront/stores/bookingStore'

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

        { path: '/login', name: 'login', component: LoginPage },
        { path: '/register', name: 'register', component: RegisterPage },
        { path: '/forgot-password', name: 'forgot-password', component: ForgotPasswordPage },
        { path: '/reset-password', name: 'reset-password', component: ResetPasswordPage },
        {
            path: '/logout',
            name: 'logout',
            meta: { requiresAuth: true },
        },
        {
            path: '/booking/extras-insurance',
            name: 'booking-extras-insurance',
            component: ExtrasInsurancePage,
            meta: { requiresAuth: true },
        },
        {
            path: '/booking/driver-info',
            name: 'booking-driver-info',
            component: DriverInfoPage,
            meta: { requiresAuth: true },
        },
        {
            path: '/booking/payment',
            name: 'booking-payment',
            component: PaymentPage,
            meta: { requiresAuth: true },
        },
        {
            path: '/booking/success',
            name: 'booking-success',
            component: SuccessPage,
            meta: { requiresAuth: true },
        },
        {
            path: '/booking/failure',
            name: 'booking-failure',
            component: FailurePage,
            meta: { requiresAuth: true },
        },

        {
            path: '/privacy-policy',
            name: 'privacy-policy',
            component: PrivacyPolicyPage,
        },

        {
            path: '/terms-and-conditions',
            name: 'terms-conditions',
            component: TermsConditionsPage,
        },

        {
            path: '/cookie-policy',
            name: 'cookie-policy',
            component: CookiePolicyPage,
        },

        {
            path: '/refund-and-cancellation-policy',
            name: 'refund-and-cancellation-policy',
            component: RefundCancellationPolicyPage,
        },

        {
            path: '/faq',
            name: 'faq',
            component: FaqPage,
        },

        {
            path: '/rental-requirements',
            name: 'rental-requirements',
            component: RentalRequirementsPage,
        },

        { path: '/fleet', name: 'fleet', component: FleetPage },
        { path: '/car/:id', name: 'car', component: DetailPage },
        { path: '/services', name: 'services', component: ServicesPage },
        { path: '/services', name: 'services', component: ServicesPage },

        {
            path: '/profile',
            name: 'profile',
            redirect: () => {
                return { path: '/profile/basic-details' }
            },
            meta: {
                requiresAuth: true,
            },
        },

        {
            path: '/profile/basic-details',
            name: 'basic-details',
            component: ProfileBasicDetailsPage,
            parent: 'profile',
            meta: { requiresAuth: true },
        },
    ],
})

router.beforeEach(to => {
    const bookingStore = useBookingStore()

    const bookingRoutes = ['booking-extras-insurance', 'booking-driver-info', 'booking-payment']

    if (bookingRoutes.includes(to.name)) {
        if (!bookingStore.carId) {
            return {
                name: 'fleet',
            }
        }
    }
})

// Register global navigation guard
router.beforeEach((to, from, next) => {
    const menuStore = useMobileMenuStore()
    menuStore.closeMenu() // Close mobile menu on every route change
    next()
})

router.beforeEach(async to => {
    const auth = useAuthStore()

    await auth.init()

    // is this work?
    if (to.meta.requiresAuth && !auth.user?.id) {
        return { name: 'home' }
    }

    if (to.name === 'login' && auth.user?.id) {
        return { name: 'home' }
    }

    if (to.name === 'logout') {
        await auth.logout()
        return { name: 'home' }
    }
})

// for debugging purposes, log the route changes
/*
router.beforeEach((to, from, next) => {
    console.log('---------------------')
    console.log('FROM:', from.fullPath)
    console.log('TO:', to.fullPath)
    console.log('HISTORY STATE:', window.history.state)
    next()
})

router.afterEach((to, from) => {
    console.log('AFTER')
    console.log('FROM:', from.fullPath)
    console.log('TO:', to.fullPath)
})
*/

export default router
