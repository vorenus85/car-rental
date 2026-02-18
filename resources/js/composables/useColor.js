import { fetchColors, deleteColorById, fetchColor } from '@/services/colorService'
import { useCustomToast } from '@/composables/useCustomToast'
import { reactive, ref } from 'vue'
import { useRoute } from 'vue-router'

export const useColor = () => {
    const loading = ref(false)
    const colors = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const colorId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
        hex_code: '',
    })

    const colorValidator = ({ values }) => {
        const errors = {}

        if (!values.name) {
            errors.name = [{ message: 'Color name is required.' }]
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

    const getColors = async () => {
        loading.value = true

        try {
            const { data } = await fetchColors()
            colors.value = data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getColor = async () => {
        loading.value = true

        try {
            const { data } = await fetchColor(colorId)
            initialValues.name = data.name
            initialValues.hex_code = data.hex_code
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteColor = async id => {
        loading.value = true

        try {
            await deleteColorById(id)
            const idIndex = colors.value.findIndex(el => {
                return el.id === id
            })
            colors.value.splice(idIndex, 1)

            customToast.success('Color deleted successfully!')

            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    return {
        colors,
        getColor,
        getColors,
        deleteColor,
        colorValidator,
        initialValues,
        loading,
        formKey,
        colorId,
    }
}
