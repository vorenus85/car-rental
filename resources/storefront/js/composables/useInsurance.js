import { fetchInsurances } from '@storefront/services/insuranceService'

export const useInsurance = () => {
    const getInsurances = async () => {
        try {
            const { data } = await fetchInsurances()
            return data.data
        } catch (error) {
            console.lor(error)
        }
    }

    return {
        getInsurances,
    }
}
