import { fetchExtras } from '@storefront/services/extraService'

export const useExtra = () => {
    const getExtras = async () => {
        try {
            const { data } = await fetchExtras()
            return data.data
        } catch (error) {
            console.lor(error)
        }
    }

    return {
        getExtras,
    }
}
