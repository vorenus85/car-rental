import { useRouter } from 'vue-router'

export const useRedirects = () => {
    const router = useRouter()

    const toDashboard = () => {
        router.push({ name: 'dashboard' })
    }

    const toBookingsList = () => {
        router.push({ name: 'bookings' })
    }

    const toCarsList = () => {
        router.push({ name: 'cars' })
    }

    const toCreateCar = () => {
        router.push({ name: 'cars.create' })
    }

    const toBrandsList = () => {
        router.push({ name: 'brands' })
    }

    const toCreateBrand = () => {
        router.push({ name: 'brands.create' })
    }

    const toModelsList = () => {
        router.push({ name: 'models' })
    }

    const toCreateModel = () => {
        router.push({ name: 'models.create' })
    }

    const toFeaturesList = () => {
        router.push({ name: 'features' })
    }

    const toCreateFeature = () => {
        router.push({ name: 'features.create' })
    }

    const toCalendar = () => {
        router.push({ name: 'calendar' })
    }

    const toClientsList = () => {
        router.push({ name: 'clients' })
    }

    const toSettings = () => {
        router.push({ name: 'settings' })
    }

    return {
        toDashboard,
        toBookingsList,
        toCarsList,
        toCreateCar,
        toBrandsList,
        toCreateBrand,
        toCreateModel,
        toModelsList,
        toFeaturesList,
        toCreateFeature,
        toCalendar,
        toClientsList,
        toSettings,
    }
}
