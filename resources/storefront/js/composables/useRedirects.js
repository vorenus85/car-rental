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

    return {
        toHome,
        toLogin,
        toAccount,
        toLogout,
    }
}
