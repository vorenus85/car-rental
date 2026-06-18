import { fetchRandomCars } from '@storefront/services/carService'
import { ref } from 'vue'

export const useCars = () => {
    const loadingCars = ref(false)
    const cars = ref([])

    const getRandomCars = async () => {
        loadingCars.value = true
        try {
            const { data } = await fetchRandomCars()
            cars.value = data.data
        } catch (error) {
            console.error(error)
        } finally {
            loadingCars.value = false
        }
    }

    return {
        cars,
        loadingCars,
        getRandomCars,
    }
}
