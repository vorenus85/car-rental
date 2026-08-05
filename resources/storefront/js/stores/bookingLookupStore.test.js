import { describe, it, expect, beforeEach } from 'vitest'
import { createPinia, setActivePinia } from 'pinia'

import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'

describe('useBookingLookupStore', () => {
    beforeEach(() => {
        setActivePinia(createPinia())
    })

    it('should have default state', () => {
        const store = useBookingLookupStore()

        expect(store.carData).toBeNull()
        expect(store.pickUpLocation).toBeNull()
        expect(store.dropOffLocation).toBeNull()
        expect(store.pickUpDate).toBeNull()
        expect(store.pickUpTime).toBeNull()
        expect(store.dropOffDate).toBeNull()
        expect(store.dropOffTime).toBeNull()
        expect(store.extrasData).toEqual([])
        expect(store.insuranceData).toBe(0)
    })

    it('should set booking data', () => {
        const store = useBookingLookupStore()

        const bookingData = {
            carData: { id: 1, name: 'BMW X5' },
            pickUpLocation: { id: 2, name: 'Budapest Airport' },
            dropOffLocation: { id: 3, name: 'Vienna Airport' },
            pickUpDate: '2026-08-10',
            pickUpTime: '10:00',
            dropOffDate: '2026-08-15',
            dropOffTime: '20:00',
        }

        store.setBookingData(bookingData)

        expect(store.carData).toEqual(bookingData.carData)
        expect(store.pickUpLocation).toEqual(bookingData.pickUpLocation)
        expect(store.dropOffLocation).toEqual(bookingData.dropOffLocation)
        expect(store.pickUpDate).toBe('2026-08-10')
        expect(store.pickUpTime).toBe('10:00')
        expect(store.dropOffDate).toBe('2026-08-15')
        expect(store.dropOffTime).toBe('20:00')
    })

    it('should set extras', () => {
        const store = useBookingLookupStore()

        const extras = [
            { id: 1, name: 'GPS', quantity: 2 },
            { id: 2, name: 'Child seat', quantity: 1 },
        ]

        store.setExtras(extras)

        expect(store.extrasData).toEqual(extras)
    })

    it('should set insurance', () => {
        const store = useBookingLookupStore()

        const insurance = {
            id: 3,
            name: 'Full coverage',
            price: 25,
        }

        store.setInsurance(insurance)

        expect(store.insuranceData).toEqual(insurance)
    })
})
