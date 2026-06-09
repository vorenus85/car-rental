import { useToast } from 'primevue/usetoast'

export const useCustomToast = () => {
    const toast = useToast()

    const customToast = {
        error: msg => {
            toast.add({ severity: 'error', summary: msg, life: 3000 })
        },
        success: msg => {
            toast.add({ severity: 'success', summary: msg, life: 3000 })
        },
    }

    return {
        customToast,
    }
}
