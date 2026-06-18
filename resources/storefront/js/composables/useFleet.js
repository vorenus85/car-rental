import { fetchCars } from '@storefront/services/carService.js'
import { ref } from 'vue'

export const useFleet = () => {
    const loadingCars = ref(false)
    const cars = ref([])
    const currentPage = ref(1)
    const perPage = ref(12)
    const total = ref(0)

    const getCars = async params => {
        loadingCars.value = true
        try {
            const result = await fetchCars(params)

            total.value = result.data.meta.total
            currentPage.value = result.data.meta.current_page
            perPage.value = result.data.meta.per_page
            cars.value = result.data.data
        } catch (error) {
            console.error(error)
        } finally {
            loadingCars.value = false
        }
    }

    return {
        getCars,
        cars,
        loadingCars,
        currentPage,
        perPage,
        total,
    }
}
