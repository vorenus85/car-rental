import { describe, it, expect, vi } from 'vitest'

const pushMock = vi.fn()

vi.mock('vue-router', () => {
    return {
        useRouter: () => ({
            push: pushMock,
        }),
    }
})

import { useRedirects } from './useRedirects'

describe('useRedirects', () => {
    it('redirects to dashboard', () => {
        const { toDashboard } = useRedirects()

        toDashboard()

        expect(pushMock).toHaveBeenCalledWith({ name: 'dashboard' })
    })

    it('redirects to bookings list', () => {
        const { toBookingsList } = useRedirects()

        toBookingsList()

        expect(pushMock).toHaveBeenCalledWith({ name: 'bookings' })
    })

    it('redirects to cars list', () => {
        const { toCarsList } = useRedirects()

        toCarsList()

        expect(pushMock).toHaveBeenCalledWith({ name: 'cars' })
    })

    it('redirects to create car', () => {
        const { toCreateCar } = useRedirects()

        toCreateCar()

        expect(pushMock).toHaveBeenCalledWith({ name: 'cars.create' })
    })

    it('redirects to brands list', () => {
        const { toBrandsList } = useRedirects()

        toBrandsList()

        expect(pushMock).toHaveBeenCalledWith({ name: 'brands' })
    })

    it('redirects to create brand', () => {
        const { toCreateBrand } = useRedirects()

        toCreateBrand()

        expect(pushMock).toHaveBeenCalledWith({ name: 'brands.create' })
    })

    it('redirects to models list', () => {
        const { toModelsList } = useRedirects()

        toModelsList()

        expect(pushMock).toHaveBeenCalledWith({ name: 'models' })
    })

    it('redirects to create model', () => {
        const { toCreateModel } = useRedirects()

        toCreateModel()

        expect(pushMock).toHaveBeenCalledWith({ name: 'models.create' })
    })

    it('redirects to variants list', () => {
        const { toVariantsList } = useRedirects()

        toVariantsList()

        expect(pushMock).toHaveBeenCalledWith({ name: 'variants' })
    })

    it('redirects to variant create', () => {
        const { toCreateVariant } = useRedirects()

        toCreateVariant()

        expect(pushMock).toHaveBeenCalledWith({ name: 'variants.create' })
    })

    it('redirects to features list', () => {
        const { toFeaturesList } = useRedirects()

        toFeaturesList()

        expect(pushMock).toHaveBeenCalledWith({ name: 'features' })
    })

    it('redirects to create feature', () => {
        const { toCreateFeature } = useRedirects()

        toCreateFeature()

        expect(pushMock).toHaveBeenCalledWith({ name: 'features.create' })
    })

    it('redirects to calendar', () => {
        const { toCalendar } = useRedirects()

        toCalendar()

        expect(pushMock).toHaveBeenCalledWith({ name: 'calendar' })
    })

    it('redirects to clients list', () => {
        const { toClientsList } = useRedirects()

        toClientsList()

        expect(pushMock).toHaveBeenCalledWith({ name: 'clients' })
    })

    it('redirects to settings', () => {
        const { toSettings } = useRedirects()

        toSettings()

        expect(pushMock).toHaveBeenCalledWith({ name: 'settings' })
    })

    it('redirects to login', () => {
        const { toLogin } = useRedirects()

        toLogin()

        expect(pushMock).toHaveBeenCalledWith({ name: 'login' })
    })

    it('redirects to user create', () => {
        const { toCreateUser } = useRedirects()

        toCreateUser()

        expect(pushMock).toHaveBeenCalledWith({ name: 'users.create' })
    })

    it('redirects to user list', () => {
        const { toUsersList } = useRedirects()

        toUsersList()

        expect(pushMock).toHaveBeenCalledWith({ name: 'users' })
    })
})
