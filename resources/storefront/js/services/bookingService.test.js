import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import { getBookingData, createBooking } from '@storefront/services/bookingService'

vi.mock('axios')

describe('bookingService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    describe('getBookingData', () => {
        it('should call GET /api/storefront/booking with params', async () => {
            const params = {
                carId: 12,
                pickUpLocationId: 3,
                dropOffLocationId: 5,
            }

            axios.get.mockResolvedValue({
                data: {},
            })

            const response = await getBookingData(params)

            expect(axios.get).toHaveBeenCalledWith('/api/storefront/booking', {
                params,
            })
            expect(response.data).toEqual({})
        })
    })

    describe('createBooking', () => {
        it('should call POST /api/storefront/booking with payload', async () => {
            const payload = {
                carId: 12,
                pickUpLocationId: 3,
                dropOffLocationId: 5,
                pickUpDate: '2026-08-10',
                dropOffDate: '2026-08-15',
            }

            axios.post.mockResolvedValue({
                data: {
                    success: true,
                },
            })

            const response = await createBooking(payload)

            expect(axios.post).toHaveBeenCalledWith('/api/storefront/booking', payload)
            expect(response.data.success).toBe(true)
        })
    })
})
