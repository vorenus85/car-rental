import { fetchCarModels, deleteCarModelById, fetchCarModel } from '@/services/carModelService'
import { useCustomToast } from '@/composables/useCustomToast'
import { reactive, ref } from 'vue'
import { useRoute } from 'vue-router'

export const useCarModel = () => {
    const loading = ref(false)
    const carModels = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const modelId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
        brand_id: '',
        description: '',
    })

    const modelValidator = ({ values }) => {
        const errors = {}

        if (!values.name) {
            errors.name = [{ message: 'Model name is required.' }]
        }

        if (!values.brand) {
            errors.brand = [{ message: 'Brand is required.' }]
        }

        if (Object.keys(errors).length) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            })
        }

        return {
            values,
            errors,
        }
    }

    const getCarModels = async () => {
        loading.value = true

        try {
            const { data } = await fetchCarModels()
            carModels.value = data.data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getCarModel = async () => {
        loading.value = true

        try {
            const { data } = await fetchCarModel(modelId)
            initialValues.name = data.name
            initialValues.description = data.description
            initialValues.brand_id = data.brand_id
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteCarModel = async id => {
        loading.value = true

        try {
            await deleteCarModelById(id)
            const idIndex = models.value.findIndex(el => {
                return el.id === id
            })
            models.value.splice(idIndex, 1)

            customToast.success('Model deleted successfully!')
        } catch (e) {
            const message =
                e?.response?.data?.message || 'Something went wrong while deleting the car model.'

            customToast.error(message)
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        carModels,
        getCarModel,
        getCarModels,
        deleteCarModel,
        modelValidator,
        initialValues,
        loading,
        formKey,
        modelId,
    }
}
