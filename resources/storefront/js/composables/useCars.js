import { fetchRandomCars, fetchSimilarCars } from '@storefront/services/carService'
import { ref } from 'vue'

export const useCars = () => {
    const loadingCars = ref(false)
    const cars = ref([])

    const filterParams = {
        carTypes: [
            { label: 'SUV', value: 'suv' },
            { label: 'Sedan', value: 'sedan' },
            { label: 'Hatchback', value: 'hatchback' },
            { label: 'Coupe', value: 'coupe' },
            { label: 'Wagon', value: 'wagon' },
        ],
        transmissions: [
            { label: 'Automatic', value: 'automatic' },
            { label: 'Manual', value: 'manual' },
        ],
        fuelTypes: [
            { label: 'Petrol', value: 'petrol' },
            { label: 'Diesel', value: 'diesel' },
            { label: 'Hybrid', value: 'hybrid' },
            { label: 'Electric', value: 'electric' },
        ],
        seats: [2, 4, 5, 6],
        luggageCounts: [1, 2, 3, 4, 5],
    }

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

    const getSimilarCars = async id => {
        loadingCars.value = true
        try {
            const { data } = await fetchSimilarCars(id)
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
        filterParams,
        getSimilarCars,
    }
}
