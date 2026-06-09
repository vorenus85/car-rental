import { fetchFeatures, deleteFeatureById, fetchFeature } from '@admin/services/featureService'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { reactive, ref, computed } from 'vue'
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
        category: '',
    })

    const featureCategories = [
        { id: 'safety', label: 'Safety' },
        { id: 'comfort', label: 'Comfort' },
        { id: 'technology', label: 'Technology' },
        { id: 'driving', label: 'Driving' },
    ]

    const groupedFeatures = computed(() => {
        const result = featureCategories.map(category => ({
            ...category,
            features: [],
        }))

        features.value.forEach(feature => {
            const categoryGroup = result.find(group => group.id === feature.category)

            if (categoryGroup) {
                categoryGroup.features.push(feature)
            }
        })

        return result
    })

    const getFeatures = async () => {
        loading.value = true

        try {
            const { data } = await fetchFeatures()
            features.value = data.data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const getFeature = async () => {
        loading.value = true

        try {
            const { data } = await fetchFeature(featureId)
            initialValues.name = data.name
            initialValues.description = data.description
            initialValues.category = data.category
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
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
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        features,
        getFeature,
        getFeatures,
        deleteFeature,
        groupedFeatures,
        featureCategories,
        initialValues,
        loading,
        formKey,
        featureId,
    }
}
