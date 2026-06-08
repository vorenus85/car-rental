import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useLocation } from '@admin/composables/useLocation'
import {
    fetchLocations,
    fetchLocation,
    deleteLocationById,
    fetchLocationsMinimal,
} from '@admin/services/locationService'

const successMock = vi.fn()

vi.mock('@admin/services/locationService', () => ({
    fetchLocations: vi.fn(),
    fetchLocation: vi.fn(),
    deleteLocationById: vi.fn(),
    fetchLocationsMinimal: vi.fn(),
}))

vi.mock('@admin/composables/useCustomToast', () => ({
    useCustomToast: () => ({
        customToast: {
            success: successMock,
        },
    }),
}))

vi.mock('vue-router', () => ({
    useRoute: () => ({
        params: {
            id: 123,
        },
    }),
}))

describe('useLocation', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should fetch locations', async () => {
        const locationsData = [
            { id: 1, name: 'Budapest Airport' },
            { id: 2, name: 'Vienna Airport' },
        ]

        fetchLocations.mockResolvedValue({
            data: locationsData,
        })

        const { getLocations, locations, loading } = useLocation()

        await getLocations()

        expect(fetchLocations).toHaveBeenCalled()
        expect(locations.value).toEqual(locationsData)
        expect(loading.value).toBe(false)
    })

    it('should fetch locations for select', async () => {
        const locationsData = [
            { id: 1, name: 'Budapest Airport' },
            { id: 2, name: 'Vienna Airport' },
        ]

        fetchLocationsMinimal.mockResolvedValue({
            data: locationsData,
        })

        const { getLocationOptions, locations, loading } = useLocation()

        await getLocationOptions()

        expect(fetchLocationsMinimal).toHaveBeenCalled()
        expect(locations.value).toEqual(locationsData)
        expect(loading.value).toBe(false)
    })

    it('should fetch location details', async () => {
        fetchLocation.mockResolvedValue({
            data: {
                name: 'Budapest Airport',
                city: 'Budapest',
                country: 'hu',
                address: 'Airport road',
                type: 'airport',
                phone: '+361234567',
                email: 'airport@test.com',
                description: 'Test description',
                active: 1,
                business_hours: {},
            },
        })

        const { getLocation, initialValues, formKey } = useLocation()

        await getLocation()

        expect(fetchLocation).toHaveBeenCalledWith(123)
        expect(initialValues.name).toBe('Budapest Airport')
        expect(initialValues.email).toBe('airport@test.com')
        expect(initialValues.active).toBe(true)
        expect(formKey.value).toBe(1)
    })

    it('should delete location', async () => {
        deleteLocationById.mockResolvedValue({})

        const { deleteLocation, locations } = useLocation()

        locations.value = [
            { id: 1, name: 'Budapest' },
            { id: 2, name: 'Vienna' },
        ]

        await deleteLocation(1)

        expect(deleteLocationById).toHaveBeenCalledWith(1)

        expect(locations.value).toEqual([{ id: 2, name: 'Vienna' }])

        expect(successMock).toHaveBeenCalledWith('Location deleted successfully!')
    })

    it('should set loading false when getLocations fails', async () => {
        fetchLocations.mockRejectedValue(new Error('API error'))

        const { getLocations, loading } = useLocation()

        await getLocations()

        expect(loading.value).toBe(false)
    })

    it('should set loading false when delete fails', async () => {
        deleteLocationById.mockRejectedValue(new Error('API error'))

        const { deleteLocation, loading } = useLocation()

        await deleteLocation(1)

        expect(loading.value).toBe(false)
    })
})
