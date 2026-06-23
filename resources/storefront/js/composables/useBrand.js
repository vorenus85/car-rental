import { fetchBrands } from '@storefront/services/brandService'

export const useBrand = () => {
    const getBrands = async () => {
        try {
            const { data } = await fetchBrands()
            return data.data
        } catch (error) {
            console.lor(error)
        }
    }

    return {
        getBrands,
    }
}
