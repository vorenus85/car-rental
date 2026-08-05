import { describe, it, expect, vi, beforeEach, afterEach } from 'vitest'
import { createPinia, setActivePinia } from 'pinia'

import { useBooking } from '@storefront/composables/useBooking'
import { useBookingStore } from '@storefront/stores/bookingStore'
import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'
import { getBookingData } from '@storefront/services/bookingService'

vi.mock('@storefront/services/bookingService', () => ({
    getBookingData: vi.fn(),
}))

describe('useBooking', () => {
    beforeEach(() => {
        setActivePinia(createPinia())
        vi.useFakeTimers()
        vi.setSystemTime(new Date('2026-08-05T12:00:00.000Z'))
        vi.clearAllMocks()
    })

    afterEach(() => {
        vi.useRealTimers()
    })

    it('should expose date limits and calculate rental values', () => {
        const booking = useBooking()

        expect(booking.maxBirthDate).toBeInstanceOf(Date)
        expect(booking.maxBirthDate.getFullYear()).toBe(2001)

        expect(booking.maxLicenceDate).toBeInstanceOf(Date)
        expect(booking.maxLicenceDate.getFullYear()).toBe(2024)

        expect(booking.calcRentalPeriod('2026-08-10', '2026-08-15')).toBe(5)

        expect(
            booking.calcFee({
                price: 25,
                pickUpDate: '2026-08-10',
                dropOffDate: '2026-08-15',
            })
        ).toBe(125)
    })

    it('should compute booking totals from lookup store', () => {
        const bookingLookupStore = useBookingLookupStore()
        const booking = useBooking()

        bookingLookupStore.setBookingData({
            carData: { pricePerDay: 40 },
            pickUpLocation: { id: 1, name: 'Budapest', city: 'Budapest' },
            dropOffLocation: { id: 2, name: 'Vienna', city: 'Vienna' },
            pickUpDate: '2026-08-10',
            pickUpTime: '10:00',
            dropOffDate: '2026-08-15',
            dropOffTime: '20:00',
        })
        bookingLookupStore.setExtras([
            { id: 1, price: 10, quantity: 2 },
            { id: 2, price: 5, quantity: 1 },
        ])
        bookingLookupStore.setInsurance({
            id: 3,
            price: 7,
        })

        expect(booking.baseRentalFee.value).toBe(200)
        expect(booking.insuranceFee.value).toBe(35)
        expect(booking.extrasFee.value).toBe(125)
        expect(booking.bookingTotal.value).toBe(360)
    })

    it('should load booking data into lookup store', async () => {
        const bookingStore = useBookingStore()
        const bookingLookupStore = useBookingLookupStore()
        const booking = useBooking()

        bookingStore.setBookingData({
            carId: 12,
            pickUpLocationId: 3,
            dropOffLocationId: 7,
            pickUpDate: '2026-08-10',
            pickUpTime: '10:00',
            dropOffDate: '2026-08-15',
            dropOffTime: '20:00',
        })

        vi.mocked(getBookingData).mockResolvedValue({
            data: {
                car: {
                    id: 12,
                    name: 'BMW X5',
                    pricePerDay: 40,
                    imageUrl: '/cars/bmw-x5.jpg',
                },
                pickUpLocation: {
                    id: 3,
                    name: 'Budapest Airport',
                    city: 'Budapest',
                },
                dropOffLocation: {
                    id: 7,
                    name: 'Vienna Airport',
                    city: 'Vienna',
                },
            },
        })

        await booking.loadBookingData({
            carId: 12,
            pickUpLocationId: 3,
            dropOffLocationId: 7,
        })

        expect(getBookingData).toHaveBeenCalledWith({
            carId: 12,
            pickUpLocationId: 3,
            dropOffLocationId: 7,
        })

        expect(bookingLookupStore.carData).toEqual({
            id: 12,
            name: 'BMW X5',
            pricePerDay: 40,
            imageUrl: '/cars/bmw-x5.jpg',
        })
        expect(bookingLookupStore.pickUpLocation).toEqual({
            id: 3,
            name: 'Budapest Airport',
            city: 'Budapest',
        })
        expect(bookingLookupStore.dropOffLocation).toEqual({
            id: 7,
            name: 'Vienna Airport',
            city: 'Vienna',
        })
        expect(bookingLookupStore.pickUpDate).toBe('2026-08-10')
        expect(bookingLookupStore.pickUpTime).toBe('10:00')
        expect(bookingLookupStore.dropOffDate).toBe('2026-08-15')
        expect(bookingLookupStore.dropOffTime).toBe('20:00')
    })

    it('should ignore loadBookingData errors', async () => {
        vi.mocked(getBookingData).mockRejectedValue(new Error('API Error'))

        const booking = useBooking()

        await expect(
            booking.loadBookingData({
                carId: 12,
                pickUpLocationId: 3,
                dropOffLocationId: 7,
            })
        ).resolves.toBeUndefined()
    })
})
