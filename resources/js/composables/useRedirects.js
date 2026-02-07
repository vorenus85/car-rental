import { useRouter } from 'vue-router'

export const useRedirects = () => {
    const router = useRouter()

    const toDashboard = () => {
        router.push({ name: 'dashboard' })
    }

    return {
        toDashboard,
    }
}
