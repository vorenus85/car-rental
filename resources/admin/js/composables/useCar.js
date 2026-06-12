import {
    fetchCars,
    deleteCarById,
    uploadCarImage,
    fetchCar,
    deleteCarImage,
} from '@admin/services/carService'
import { reactive, ref } from 'vue'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { useRoute } from 'vue-router'

export const useCar = () => {
    const loading = ref(false)
    const cars = ref([])
    const route = useRoute()
    const carId = route.params.id
    const formKey = ref(0)
    const isUploading = ref(false)
    const uploadProgress = ref(0)
    const uploadedImage = ref(null)

    const selectedCategory = ref(null)
    const selectedBodyType = ref(null)
    const selectedTransmission = ref(null)
    const selectedFuelType = ref(null)
    const selectedSeats = ref(null)
    const selectedDoors = ref(null)
    const selectedLuggageCount = ref(null)
    const selectedRangeKm = ref(null)

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        brand_id: null,
        model_id: null,
        variant_id: null,
        location_id: null,
        licence_plate: '',
        color: '',
        production_year: null,
        mileage: null,
        price_per_day: null,
        status: '',
        description: '',
        features: [],
    })

    const rentalStatuses = [
        { id: 'available', name: 'Available' },
        { id: 'reserved', name: 'Reserved' },
        { id: 'rented', name: 'Rented' },
        { id: 'maintenance', name: 'Maintenance' },
        { id: 'inactive', name: 'inactive' },
    ]

    const onRemoveImage = () => {
        isUploading.value = false
        uploadProgress.value = 0
    }

    const onClearUploaderStatus = () => {
        isUploading.value = false
        uploadProgress.value = 0
    }

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

    const getCar = async () => {
        loading.value = true

        try {
            const { data } = await fetchCar(carId)

            initialValues.brand_id = data.variant.model.brand.id
            initialValues.model_id = data.variant.model.id
            initialValues.variant_id = data.variant.id
            initialValues.location_id = data.location_id

            initialValues.licence_plate = data.licence_plate
            initialValues.color = data.color
            initialValues.production_year = data.production_year
            initialValues.mileage = data.mileage
            initialValues.price_per_day = data.price_per_day
            initialValues.status = data.status
            initialValues.description = data.description

            initialValues.image = data.image
            initialValues.image_url = data.image_url

            initialValues.features = data.features.map(f => f.id)

            selectedCategory.value = data.variant.category
            selectedBodyType.value = data.variant.body_type
            selectedTransmission.value = data.variant.transmission
            selectedFuelType.value = data.variant.fuel_type
            selectedSeats.value = data.variant.seats
            selectedDoors.value = data.variant.doors
            selectedLuggageCount.value = data.luggage_count
            selectedRangeKm.value = data.range_km

            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792

            loading.value = false
        } catch (e) {
            console.error(e)
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteCar = async id => {
        loading.value = true

        try {
            await deleteCarById(id)
            const idIndex = cars.value.findIndex(el => {
                return el.id === id
            })
            cars.value.splice(idIndex, 1)

            customToast.success('Car deleted successfully!')
        } catch (e) {
            const message =
                e?.response?.data?.message || 'Something went wrong while deleting the car.'

            customToast.error(message)
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const onImageUpload = async event => {
        try {
            isUploading.value = true
            const file = event.files[0]

            const formData = new FormData()
            formData.append('file', file)

            const { data } = await uploadCarImage(file, progress => {
                uploadProgress.value = progress
            })

            uploadedImage.value = data.filename
        } catch (e) {
            isUploading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteImage = async () => {
        try {
            await deleteCarImage(carId)
            initialValues.image = ''
            uploadedImage.value = ''
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    return {
        loading,
        cars,
        formKey,
        getCars,
        getCar,
        initialValues,
        isUploading,
        uploadProgress,
        uploadedImage,
        onRemoveImage,
        onClearUploaderStatus,
        onImageUpload,
        deleteCar,
        deleteImage,
        rentalStatuses,
        selectedCategory,
        selectedBodyType,
        selectedTransmission,
        selectedFuelType,
        selectedSeats,
        selectedDoors,
        selectedLuggageCount,
        selectedRangeKm,
        carId,
    }
}
