import { fetchVariants, deleteVariantById, fetchVariant } from '@/services/variantService'
import { useCustomToast } from '@/composables/useCustomToast'
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
        description: '',
        features: [],
    })

    const selectedBrand = ref({ id: null, name: null })

    const variantValidator = ({ values }) => {
        const errors = {}

        if (!values.name) {
            errors.name = [{ message: 'Please enter a variant name.' }]
        }

        if (!values.brand_id) {
            errors.brand_id = [{ message: 'Please select a brand.' }]
        }

        if (!values.model_id) {
            errors.model_id = [{ message: 'Please select a model.' }]
        }

        if (!values.category) {
            errors.category = [{ message: 'Please select a category.' }]
        }

        if (!values.body_type) {
            errors.body_type = [{ message: 'Please select a body type.' }]
        }

        if (!values.transmission) {
            errors.transmission = [{ message: 'Please select a transmission type.' }]
        }

        if (!values.fuel) {
            errors.fuel = [{ message: 'Please select a fuel type.' }]
        }

        if (!values.seats) {
            errors.seats = [{ message: 'Please enter the number of seats.' }]
        } else if (Number(values.seats < 1)) {
            errors.seats = [{ message: 'Seats must be minimum 1.' }]
        }

        if (!values.doors) {
            errors.doors = [{ message: 'Please enter the number of doors.' }]
        } else if (Number(values.doors) < 1) {
            errors.doors = [{ message: 'Doors must be minimum 1.' }]
        }

        /*
        if (Object.keys(errors).length) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            })
        }
        */

        return {
            values,
            errors,
        }
    }

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
        selectedBrand,
        selectedFeatures,
        getVariant,
        getVariants,
        deleteVariant,
        variantCategories,
        variantValidator,
        initialValues,
        bodyTypes,
        transmissions,
        fuelTypes,
        variants,
        variantId,
        formKey,
    }
}
