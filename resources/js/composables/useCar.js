import { fetchCars } from '@/services/carService'
import { reactive, ref } from 'vue'

export const useCar = () => {
    const loading = ref(false)
    const cars = ref([])
    const formKey = ref(0)

    const getCars = async () => {
        loading.value = true

        try {
            const { data } = await fetchCars()
            cars.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        loading,
        cars,
        formKey,
        getCars,
    }
}
