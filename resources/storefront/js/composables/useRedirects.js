import { useRouter } from 'vue-router'

export const useRedirects = () => {
    const router = useRouter()

    const toHome = () => {
        router.push({ name: 'home' })
    }

    const toLogin = () => {
        router.push({ name: 'login' })
    }

    const toAccount = () => {
        router.push({ name: 'account' })
    }

    const toLogout = () => {
        router.push({ name: 'logout' })
    }

    const toBookingStep1 = () => {
        router.push({ name: 'booking-extras-insurance' })
    }
    const toBookingStep2 = () => {
        router.push({ name: 'booking-driver-info' })
    }

    const toBookingStep3 = () => {
        router.push({ name: 'booking-payment' })
    }

    const toBookingStep4 = () => {
        router.push({ name: 'booking-success' })
    }

    return {
        toHome,
        toLogin,
        toAccount,
        toLogout,
        toBookingStep1,
        toBookingStep2,
        toBookingStep3,
        toBookingStep4,
    }
}
