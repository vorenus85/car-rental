import { fetchFeatures, deleteFeatureById, fetchFeature } from '@/services/featureService'
import { useCustomToast } from '@/composables/useCustomToast'
import { reactive, ref } from 'vue'
import { useRoute } from 'vue-router'

export const useFeature = () => {
    const loading = ref(false)
    const features = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const featureId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
        description: '',
    })

    const featureValidator = ({ values }) => {
        const errors = {}

        if (!values.name) {
            errors.name = [{ message: 'Feature name is required.' }]
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

    const getFeatures = async () => {
        loading.value = true

        try {
            const { data } = await fetchFeatures()
            colors.value = data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getFeature = async () => {
        loading.value = true

        try {
            const { data } = await fetchFeature(featureId)
            initialValues.name = data.name
            initialValues.description = data.description
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteFeature = async id => {
        loading.value = true

        try {
            await deleteFeatureById(id)
            const idIndex = features.value.findIndex(el => {
                return el.id === id
            })
            features.value.splice(idIndex, 1)

            customToast.success('Feature deleted successfully!')

            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    return {
        features,
        getFeature,
        getFeatures,
        deleteFeature,
        featureValidator,
        initialValues,
        loading,
        formKey,
        featureId,
    }
}
