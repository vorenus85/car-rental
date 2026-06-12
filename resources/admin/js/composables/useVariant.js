import {
    fetchVariants,
    deleteVariantById,
    fetchVariant,
    fetchVariantsByCarModel,
} from '@admin/services/variantService'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { ref, reactive } from 'vue'
import { useRoute } from 'vue-router'

export const useVariant = () => {
    const loading = ref(false)
    const variants = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const variantId = route.params.id
    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
        brand_id: '',
        model_id: '',
        category: '',
        body_type: '',
        transmission: 'manual',
        fuel: 'petrol',
        seats: '1',
        doors: '1',
        luggage_count: '1',
        range_km: '100',
        description: '',
        features: [],
    })

    const selectedBrand = ref({ id: null, name: null })

    const selectedCarModel = ref({ id: null, name: null })
    const selectedVariant = ref({ id: null, name: null })

    const selectedFeatures = ref([])

    const variantCategories = [
        {
            id: 'economy',
            label: 'Economy',
        },
        {
            id: 'compact',
            label: 'Compact',
        },
        {
            id: 'suv',
            label: 'SUV',
        },
        {
            id: 'business',
            label: 'Business',
        },
        {
            id: 'premium',
            label: 'Premium',
        },
    ]

    const bodyTypes = [
        {
            id: 'suv',
            label: 'SUV',
        },
        {
            id: 'sedan',
            label: 'Sedan',
        },
        {
            id: 'hatchback',
            label: 'Hatchback',
        },
        {
            id: 'coupe',
            label: 'Coupe',
        },
        {
            id: 'wagon',
            label: 'Wagon',
        },
    ]

    const transmissions = [
        {
            id: 'manual',
            label: 'Manual',
        },
        {
            id: 'automatic',
            label: 'Automatic',
        },
    ]

    const fuelTypes = [
        {
            id: 'petrol',
            label: 'Petrol',
        },
        {
            id: 'diesel',
            label: 'Diesel',
        },
        {
            id: 'electric',
            label: 'Electric',
        },
        {
            id: 'hybrid',
            label: 'Hybrid',
        },
    ]

    const getVariant = async () => {
        loading.value = true

        try {
            const { data } = await fetchVariant(variantId)
            initialValues.name = data.name

            initialValues.category = data.category
            initialValues.body_type = data.body_type
            initialValues.transmission = data.transmission
            initialValues.fuel = data.fuel
            initialValues.seats = data.seats
            initialValues.doors = data.doors
            initialValues.luggage_count = data.luggage_count
            initialValues.range_km = data.range_km
            initialValues.description = data.description
            selectedFeatures.value = data.features.map(f => f.id)
            initialValues.features = data.features.map(f => f.id)

            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            selectedBrand.value = data.model.brand.id
            initialValues.brand_id = data.model.brand_id
            initialValues.model_id = data.model_id
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const getVariantById = async id => {
        loading.value = true

        try {
            const { data } = await fetchVariant(id)

            return data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

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

    const getVariantsByCarmodel = async params => {
        loading.value = true

        try {
            const { data } = await fetchVariantsByCarModel({ ...params })
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
        selectedBrand,
        selectedCarModel,
        selectedVariant,
        selectedFeatures,
        getVariant,
        getVariantById,
        getVariants,
        deleteVariant,
        getVariantsByCarmodel,
        variantCategories,
        initialValues,
        bodyTypes,
        transmissions,
        fuelTypes,
        variants,
        variantId,
        formKey,
    }
}
