import { fetchExtras, deleteExtraById, fetchExtra } from '@admin/services/extraService'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { reactive, ref } from 'vue'
import { useRoute } from 'vue-router'

export const useExtra = () => {
    const loading = ref(false)
    const extras = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const extraId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
        description: '',
        price: '',
        icon: '',
        maxQuantity: '',
    })

    const getExtras = async () => {
        loading.value = true

        try {
            const { data } = await fetchExtras()
            extras.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const getExtra = async () => {
        loading.value = true

        try {
            const { data } = await fetchExtra(extraId)
            initialValues.name = data.name
            initialValues.description = data.description
            initialValues.price = data.price
            initialValues.icon = data.icon
            initialValues.maxQuantity = data.maxQuantity
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const deleteExtra = async id => {
        loading.value = true

        try {
            await deleteExtraById(id)
            const idIndex = extras.value.findIndex(el => {
                return el.id === id
            })
            extras.value.splice(idIndex, 1)

            customToast.success('Extra deleted successfully!')
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        extras,
        getExtra,
        getExtras,
        deleteExtra,
        initialValues,
        loading,
        formKey,
        extraId,
    }
}
