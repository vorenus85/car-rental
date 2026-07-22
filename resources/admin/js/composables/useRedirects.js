import { useRouter } from 'vue-router'

export const useRedirects = () => {
    const router = useRouter()

    const toDashboard = () => {
        router.push({ name: 'dashboard' })
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

    const toVariantsList = () => {
        router.push({ name: 'variants' })
    }

    const toCreateVariant = () => {
        router.push({ name: 'variants.create' })
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

    const toSettings = () => {
        router.push({ name: 'settings' })
    }

    const toLogin = () => {
        router.push({ name: 'login' })
    }

    const toCreateUser = () => {
        router.push({ name: 'users.create' })
    }

    const toUsersList = () => {
        router.push({ name: 'users' })
    }

    const toCreateCustomer = () => {
        router.push({ name: 'clients.create' })
    }

    const toCustomersList = () => {
        router.push({ name: 'clients' })
    }

    const toLocationsList = () => {
        router.push({ name: 'locations' })
    }

    const toCreateLocation = () => {
        router.push({ name: 'locations.create' })
    }

    const toBookingsList = () => {
        router.push({ name: 'bookings' })
    }

    const toCreateBooking = () => {
        router.push({ name: 'bookings.create' })
    }

    const toExtrasList = () => {
        router.push({ name: 'extras' })
    }

    const toCreateExtra = () => {
        router.push({ name: 'extras.create' })
    }

    return {
        toDashboard,
        toCarsList,
        toCreateCar,
        toBrandsList,
        toCreateBrand,
        toCreateModel,
        toModelsList,
        toVariantsList,
        toCreateVariant,
        toFeaturesList,
        toCreateFeature,
        toCalendar,
        toSettings,
        toLogin,
        toCreateUser,
        toUsersList,
        toLocationsList,
        toCreateLocation,
        toCreateCustomer,
        toCustomersList,
        toBookingsList,
        toCreateBooking,
        toExtrasList,
        toCreateExtra,
    }
}
