import { fetchModels, deleteModelById, fetchModel } from '@/services/modelService'
import { useCustomToast } from '@/composables/useCustomToast'
import { reactive, ref } from 'vue'
import { useRoute } from 'vue-router'

export const useModel = () => {
    const loading = ref(false)
    const models = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const modelId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
    })

    const modelValidator = ({ values }) => {
        const errors = {}

        if (!values.name) {
            errors.name = [{ message: 'Model name is required.' }]
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

    const getModels = async () => {
        loading.value = true

        try {
            const { data } = await fetchModels()
            console.log(data)
            models.value = data.data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getModel = async () => {
        loading.value = true

        try {
            const { data } = await fetchModel(modelId)
            initialValues.name = data.name
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteModel = async id => {
        loading.value = true

        try {
            await deleteModelById(id)
            const idIndex = models.value.findIndex(el => {
                return el.id === id
            })
            models.value.splice(idIndex, 1)

            customToast.success('Model deleted successfully!')

            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    return {
        models,
        getModel,
        getModels,
        deleteModel,
        modelValidator,
        initialValues,
        loading,
        formKey,
        modelId,
    }
}
