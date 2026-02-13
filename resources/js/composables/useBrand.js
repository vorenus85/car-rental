import {
    fetchBrands,
    deleteBrandById,
    fetchBrand,
    uploadBrandImage,
    deleteBrandImage,
} from '@/services/brandService'
import { useCustomToast } from '@/composables/useCustomToast'
import { reactive, ref } from 'vue'
import { useRoute } from 'vue-router'

export const useBrand = () => {
    const loading = ref(false)
    const brands = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const brandId = route.params.id
    const isUploading = ref(false)
    const uploadProgress = ref(0)
    const uploadedImage = ref(null)

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
        image: '',
    })

    const brandValidator = ({ values }) => {
        const errors = {}

        if (!values.name) {
            errors.name = [{ message: 'Brand name is required.' }]
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

    const getBrands = async () => {
        loading.value = true

        try {
            const { data } = await fetchBrands()
            brands.value = data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getBrand = async () => {
        loading.value = true

        try {
            const { data } = await fetchBrand(brandId)
            initialValues.name = data.name
            initialValues.image = data.image
            initialValues.image_url = data.image_url
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteBrand = async id => {
        loading.value = true

        try {
            await deleteBrandById(id)
            const idIndex = brands.value.findIndex(el => {
                return el.id === id
            })
            brands.value.splice(idIndex, 1)

            customToast.success('Brand deleted successfully!')

            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const onRemoveImage = () => {
        isUploading.value = false
        uploadProgress.value = 0
    }

    const onClearUploaderStatus = () => {
        isUploading.value = false
        uploadProgress.value = 0
    }

    const onImageUpload = async event => {
        try {
            isUploading.value = true
            const file = event.files[0]

            const formData = new FormData()
            formData.append('file', file)

            const { data } = await uploadBrandImage(file, progress => {
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
            await deleteBrandImage(brandId)
            initialValues.image = ''
            uploadedImage.value = ''
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    return {
        brands,
        getBrand,
        getBrands,
        deleteBrand,
        brandValidator,
        deleteImage,
        initialValues,
        loading,
        formKey,
        brandId,
        isUploading,
        uploadProgress,
        onRemoveImage,
        onClearUploaderStatus,
        onImageUpload,
        uploadedImage,
    }
}
