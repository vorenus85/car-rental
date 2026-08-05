import { describe, it, expect, vi, beforeEach } from 'vitest'
import { createPinia, setActivePinia } from 'pinia'

import { useBookingStore } from '@storefront/stores/bookingStore'
import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'
import { fetchExtras } from '@storefront/services/extraService'
import { fetchInsurances } from '@storefront/services/insuranceService'

vi.mock('@storefront/services/extraService', () => ({
    fetchExtras: vi.fn(),
}))

vi.mock('@storefront/services/insuranceService', () => ({
    fetchInsurances: vi.fn(),
}))

describe('useBookingStore', () => {
    beforeEach(() => {
        setActivePinia(createPinia())
        vi.clearAllMocks()
    })

    it('should have default state', () => {
        const store = useBookingStore()

        expect(store.carId).toBeNull()
        expect(store.pickUpLocationId).toBeNull()
        expect(store.dropOffLocationId).toBeNull()
        expect(store.pickUpDate).toBeNull()
        expect(store.pickUpTime).toBeNull()
        expect(store.dropOffDate).toBeNull()
        expect(store.dropOffTime).toBeNull()
        expect(store.extras).toEqual([])
        expect(store.insuranceId).toBe(3)

        expect(store.driver).toEqual({
            personal: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                birthDate: null,
            },
            address: {
                country: null,
                city: '',
                postalCode: '',
                addressLine1: '',
                addressLine2: '',
            },
            licence: {
                licenceNumber: '',
                issuingCountry: null,
                issueDate: null,
                expiryDate: null,
            },
        })
    })

    it('should expose booking getters', () => {
        const store = useBookingStore()

        store.carId = 12
        store.pickUpLocationId = 3
        store.dropOffLocationId = 7
        store.pickUpDate = '2026-08-10'
        store.pickUpTime = '10:00'
        store.dropOffDate = '2026-08-15'
        store.dropOffTime = '20:00'
        store.extras = [{ id: 1, quantity: 2 }]
        store.insuranceId = 5

        store.driver.personal.firstName = 'John'
        store.driver.personal.lastName = 'Doe'
        store.driver.personal.email = 'john@example.com'
        store.driver.personal.phone = '+36123456789'
        store.driver.personal.birthDate = '1995-01-01'

        store.driver.address.country = 'hu'
        store.driver.address.city = 'Budapest'
        store.driver.address.postalCode = '1111'
        store.driver.address.addressLine1 = 'Main street 1'
        store.driver.address.addressLine2 = '2nd floor'

        store.driver.licence.licenceNumber = 'ABC12345'
        store.driver.licence.issuingCountry = 'hu'
        store.driver.licence.issueDate = '2020-01-01'
        store.driver.licence.expiryDate = '2030-01-01'

        expect(store.getBookingData).toEqual({
            carId: 12,
            pickUpLocationId: 3,
            dropOffLocationId: 7,
            pickUpDate: '2026-08-10',
            pickUpTime: '10:00',
            dropOffDate: '2026-08-15',
            dropOffTime: '20:00',
        })

        expect(store.getDriverPersonal).toEqual({
            firstName: 'John',
            lastName: 'Doe',
            email: 'john@example.com',
            phone: '+36123456789',
            birthDate: '1995-01-01',
        })

        expect(store.getDriverAddress).toEqual({
            country: 'hu',
            city: 'Budapest',
            postalCode: '1111',
            addressLine1: 'Main street 1',
            addressLine2: '2nd floor',
        })

        expect(store.getDriverLicence).toEqual({
            licenceNumber: 'ABC12345',
            issuingCountry: 'hu',
            issueDate: '2020-01-01',
            expiryDate: '2030-01-01',
        })

        expect(store.getBookingExtras).toEqual({
            extras: [{ id: 1, quantity: 2 }],
        })

        expect(store.getBookingInsurance).toEqual({
            insuranceId: 5,
        })
    })

    it('should set driver personal data', () => {
        const store = useBookingStore()

        store.setDriverPersonal({
            firstName: 'John',
            lastName: 'Doe',
            email: 'john@example.com',
            phone: '+36123456789',
            birthDate: '1995-01-01',
        })

        expect(store.driver.personal).toEqual({
            firstName: 'John',
            lastName: 'Doe',
            email: 'john@example.com',
            phone: '+36123456789',
            birthDate: '1995-01-01',
        })
    })

    it('should set driver address data', () => {
        const store = useBookingStore()

        store.setDriverAddress({
            country: 'hu',
            city: 'Budapest',
            postalCode: '1111',
            addressLine1: 'Main street 1',
            addressLine2: '2nd floor',
        })

        expect(store.driver.address).toEqual({
            country: 'hu',
            city: 'Budapest',
            postalCode: '1111',
            addressLine1: 'Main street 1',
            addressLine2: '2nd floor',
        })
    })

    it('should set driver licence data', () => {
        const store = useBookingStore()

        store.setDriverLicence({
            licenceNumber: 'ABC12345',
            issuingCountry: 'hu',
            issueDate: '2020-01-01',
            expiryDate: '2030-01-01',
        })

        expect(store.driver.licence).toEqual({
            licenceNumber: 'ABC12345',
            issuingCountry: 'hu',
            issueDate: '2020-01-01',
            expiryDate: '2030-01-01',
        })
    })

    it('should set booking data', () => {
        const store = useBookingStore()

        store.setBookingData({
            carId: 12,
            pickUpLocationId: 3,
            dropOffLocationId: 7,
            pickUpDate: '2026-08-10',
            pickUpTime: '10:00',
            dropOffDate: '2026-08-15',
            dropOffTime: '20:00',
        })

        expect(store.carId).toBe(12)
        expect(store.pickUpLocationId).toBe(3)
        expect(store.dropOffLocationId).toBe(7)
        expect(store.pickUpDate).toBe('2026-08-10')
        expect(store.pickUpTime).toBe('10:00')
        expect(store.dropOffDate).toBe('2026-08-15')
        expect(store.dropOffTime).toBe('20:00')
    })

    it('should set extras and sync them to the lookup store', async () => {
        const store = useBookingStore()
        const lookupStore = useBookingLookupStore()

        vi.mocked(fetchExtras).mockResolvedValue({
            data: {
                data: [
                    { id: 1, name: 'GPS', price: 10 },
                    { id: 2, name: 'Child seat', price: 15 },
                ],
            },
        })

        await store.setExtras([
            { id: 1, quantity: 2 },
            { id: 2, quantity: 1 },
        ])

        expect(fetchExtras).toHaveBeenCalledTimes(1)
        expect(lookupStore.extrasData).toEqual([
            { id: 1, name: 'GPS', price: 10, quantity: 2 },
            { id: 2, name: 'Child seat', price: 15, quantity: 1 },
        ])
    })

    it('should ignore missing extras when setting extras', async () => {
        const store = useBookingStore()
        const lookupStore = useBookingLookupStore()
        const errorSpy = vi.spyOn(console, 'error').mockImplementation(() => {})

        vi.mocked(fetchExtras).mockResolvedValue({
            data: {
                data: [{ id: 1, name: 'GPS', price: 10 }],
            },
        })

        await store.setExtras([
            { id: 1, quantity: 1 },
            { id: 99, quantity: 2 },
        ])

        expect(lookupStore.extrasData).toEqual([
            { id: 1, name: 'GPS', price: 10, quantity: 1 },
        ])
        expect(errorSpy).toHaveBeenCalledWith('Extra with ID 99 not found.')

        errorSpy.mockRestore()
    })

    it('should set insurance and sync it to the lookup store', async () => {
        const store = useBookingStore()
        const lookupStore = useBookingLookupStore()

        vi.mocked(fetchInsurances).mockResolvedValue({
            data: {
                data: [
                    { id: 3, name: 'Basic', price: 10 },
                    { id: 5, name: 'Full', price: 25 },
                ],
            },
        })

        await store.setInsurance(5)

        expect(fetchInsurances).toHaveBeenCalledTimes(1)
        expect(store.insuranceId).toBe(5)
        expect(lookupStore.insuranceData).toEqual({ id: 5, name: 'Full', price: 25 })
    })

    it('should keep insurance id and log when insurance is missing', async () => {
        const store = useBookingStore()
        const lookupStore = useBookingLookupStore()
        const errorSpy = vi.spyOn(console, 'error').mockImplementation(() => {})

        vi.mocked(fetchInsurances).mockResolvedValue({
            data: {
                data: [{ id: 3, name: 'Basic', price: 10 }],
            },
        })

        await store.setInsurance(99)

        expect(store.insuranceId).toBe(99)
        expect(lookupStore.insuranceData).toBe(0)
        expect(errorSpy).toHaveBeenCalledWith('Insurance with ID 99 not found.')

        errorSpy.mockRestore()
    })
})
