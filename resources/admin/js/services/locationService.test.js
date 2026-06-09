import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import {
    fetchLocations,
    fetchLocation,
    deleteLocationById,
    createLocation,
    updateLocationById,
    toggleLocationActive,
} from '@admin/services/locationService'

vi.mock('axios')

describe('locationService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should fetch locations', () => {
        fetchLocations()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/locations')
    })

    it('should fetch location by id', () => {
        fetchLocation(123)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/locations/123')
    })

    it('should delete location by id', () => {
        deleteLocationById(123)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/locations/123')
    })

    it('should create location', () => {
        const values = {
            name: 'Budapest',
            country: 'Hungary',
        }

        createLocation(values)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/locations', values)
    })

    it('should update location by id', () => {
        const values = {
            name: 'Debrecen',
        }

        updateLocationById(123, values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/locations/123', values)
    })

    it('should toggle location active status', () => {
        toggleLocationActive(123)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/locations/123/toggle-active')
    })
})
