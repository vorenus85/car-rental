import { useRouter } from 'vue-router'

export const useRedirects = () => {
    const router = useRouter()

    const toHome = () => {
        router.push({ name: 'home' })
    }

    const toProfileBookings = () => {
        router.push({ name: 'profile-bookings' })
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

    return {
        toProfileBookings,
        toHome,
        toLogin,
        toAccount,
        toLogout,
    }
}
