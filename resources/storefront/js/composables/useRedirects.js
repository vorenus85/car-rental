import { useRouter } from 'vue-router'

export const useRedirects = () => {
    const router = useRouter()

    const toHome = () => {
        router.push({ name: 'home' })
    }

    return {
        toHome,
    }
}
