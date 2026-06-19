import { computed, reactive, ref } from 'vue'
import { useRoute } from 'vue-router'
import { fetchCar } from '@storefront/services/carService.js'

export const useCar = () => {
    const route = useRoute()
    const loadingCar = ref(false)
    const car = ref({})
    const carId = route.params.id

    const specifications = computed(() => [
        {
            label: 'Car Type',
            value: car.value.body_type,
        },
        {
            label: 'Doors',
            value: car.value.doors,
        },
        {
            label: 'Seats',
            value: car.value.seats,
        },
        {
            label: 'Bags',
            value: car.value.luggage_count,
        },
        {
            label: 'Transmission',
            value: car.value.transmission,
        },
        {
            label: 'Fuel Type',
            value: car.value.fuel,
        },
        {
            label: 'Production year',
            value: car.value.production_year,
        },
        {
            label: 'Range',
            value: car.value.range_km + ' km',
        },
        {
            label: 'Mileage',
            value: car.value.mileage + ' km',
        },
        /*
        {
            label: 'Engine',
            value: car.value.engine,
        },
        {
            label: 'Fuel Consumption',
            value: car.value.fuel_consumption,
        },
        {
            label: 'Horsepower',
            value: `${car.value.horsepower} hp`,
        },
        */
    ])

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
        specifications,
    }
}
