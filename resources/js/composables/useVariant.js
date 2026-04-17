import { fetchVariants, deleteVariantById } from '@/services/variantService'
import { ref } from 'vue'
import { useRoute } from 'vue-router'

export const useVariant = () => {
    const loading = ref(false)
    const variants = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const variantId = route.params.id

    const getVariants = async () => {
        loading.value = true

        try {
            const { data } = await fetchVariants()
            variants.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const deleteVariant = async id => {
        loading.value = true

        try {
            await deleteVariantById(id)
            const idIndex = variants.value.findIndex(el => {
                return el.id === id
            })
            variants.value.splice(idIndex, 1)

            customToast.success('Variant deleted successfully!')
        } catch (e) {
            const message =
                e?.response?.data?.message || 'Something went wrong while deleting the variant.'

            customToast.error(message)
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        loading,
        getVariants,
        deleteVariant,
        variants,
        formKey,
    }
}
