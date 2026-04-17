import { fetchVariants } from '@/services/variantService'
import { ref } from 'vue'
import { useRoute } from 'vue-router'

export const useVariant = () => {
    const loading = ref(false)
    const variants = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const modelId = route.params.id

    const getVariants = async () => {
        loading.value = true

        try {
            const { data } = await fetchVariants()
            variants.value = data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    return {
        loading,
        getVariants,
        variants,
        formKey,
    }
}
