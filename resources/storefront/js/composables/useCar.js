import { computed, reactive, ref } from 'vue'
import { useRoute } from 'vue-router'
import { fetchCar } from '@storefront/services/carService.js'
import { useCars } from '@storefront/composables/useCars'

const { filterParams } = useCars()

export const useCar = () => {
    const route = useRoute()
    const loadingCar = ref(false)
    const car = ref({})
    const carId = route.params.id

    const bodyType = computed(() => {
        return filterParams.carTypes?.find(item => car.value.bodyType === item.value)
    })

    const getCar = async () => {
        loadingCar.value = true
        try {
            const { data } = await fetchCar(carId)
            car.value = data.data
        } catch (error) {
            console.log(error)
        } finally {
            loadingCar.value = false
        }
    }

    return {
        loadingCar,
        getCar,
        carId,
        car,
        bodyType,
    }
}
