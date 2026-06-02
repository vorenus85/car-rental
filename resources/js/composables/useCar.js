import { fetchCars, deleteCarById, uploadCarImage } from '@/services/carService'
import { reactive, ref } from 'vue'
import { useCustomToast } from '@/composables/useCustomToast'

export const useCar = () => {
    const loading = ref(false)
    const cars = ref([])
    const formKey = ref(0)
    const isUploading = ref(false)
    const uploadProgress = ref(0)
    const uploadedImage = ref(null)

    const { customToast } = useCustomToast()

    const initialValues = reactive({})

    const rentalStatuses = [
        { id: 'available', name: 'Available' },
        { id: 'unavailable', name: 'Unavailable' },
        { id: 'rented', name: 'Rented' },
        { id: 'retired', name: 'Retired' },
        { id: 'maintenance', name: 'Maintenance' },
        { id: 'reserved', name: 'Reserved' },
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

    return {
        loading,
        cars,
        formKey,
        getCars,
        initialValues,
        isUploading,
        uploadProgress,
        uploadedImage,
        onRemoveImage,
        onClearUploaderStatus,
        onImageUpload,
        deleteCar,
        rentalStatuses,
    }
}
