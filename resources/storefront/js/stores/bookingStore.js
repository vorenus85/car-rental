import { defineStore } from 'pinia'
import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'
import { fetchInsurances } from '@storefront/services/insuranceService'
import { fetchExtras } from '@storefront/services/extraService'

export const useBookingStore = defineStore('booking', {
    state: () => ({
        carId: null,
        pickUpLocationId: null,
        dropOffLocationId: null,
        pickUpDate: null,
        pickUpTime: null,
        dropOffDate: null,
        dropOffTime: null,
        extras: [],
        insuranceId: 3,
        driver: {
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
        },
    }),
    getters: {
        getBookingData: state => {
            return {
                carId: state.carId,
                pickUpLocationId: state.pickUpLocationId,
                dropOffLocationId: state.dropOffLocationId,
                pickUpDate: state.pickUpDate,
                pickUpTime: state.pickUpTime,
                dropOffDate: state.dropOffDate,
                dropOffTime: state.dropOffTime,
            }
        },
        getDriverPersonal: state => {
            return {
                firstName: state.driver.personal.firstName,
                lastName: state.driver.personal.lastName,
                email: state.driver.personal.email,
                phone: state.driver.personal.phone,
                birthDate: state.driver.personal.birthDate,
            }
        },
        getDriverAddress: state => {
            return {
                country: state.driver.address.country,
                city: state.driver.address.city,
                postalCode: state.driver.address.postalCode,
                addressLine1: state.driver.address.addressLine1,
                addressLine2: state.driver.address.addressLine2,
            }
        },
        getDriverLicence: state => {
            return {
                licenceNumber: state.driver.licence.licenceNumber,
                issuingCountry: state.driver.licence.issuingCountry,
                issueDate: state.driver.licence.issueDate,
                expiryDate: state.driver.licence.expiryDate,
            }
        },
        getBookingExtras: state => {
            return {
                extras: state.extras,
            }
        },
        getBookingInsurance: state => {
            return {
                insuranceId: state.insuranceId,
            }
        },
    },
    actions: {
        setDriverPersonal(data) {
            this.driver.personal.firstName = data.firstName
            this.driver.personal.lastName = data.lastName
            this.driver.personal.email = data.email
            this.driver.personal.phone = data.phone
            this.driver.personal.birthDate = data.birthDate
        },
        setDriverAddress(data) {
            this.driver.address.country = data.country
            this.driver.address.city = data.city
            this.driver.address.postalCode = data.postalCode
            this.driver.address.addressLine1 = data.addressLine1
            this.driver.address.addressLine2 = data.addressLine2
        },
        setDriverLicence(data) {
            this.driver.licence.licenceNumber = data.licenceNumber
            this.driver.licence.issuingCountry = data.issuingCountry
            this.driver.licence.issueDate = data.issueDate
            this.driver.licence.expiryDate = data.expiryDate
        },
        setBookingData(data) {
            this.carId = data.carId
            this.pickUpLocationId = data.pickUpLocationId
            this.dropOffLocationId = data.dropOffLocationId
            this.pickUpDate = data.pickUpDate
            this.pickUpTime = data.pickUpTime
            this.dropOffDate = data.dropOffDate
            this.dropOffTime = data.dropOffTime
        },
        clearBookingData() {
            this.carId = null
            this.pickUpLocationId = null
            this.dropOffLocationId = null
            this.pickUpDate = null
            this.pickUpTime = null
            this.dropOffDate = null
            this.dropOffTime = null
            this.extras = []
            this.insuranceId = 3

            // Clear driver data
            this.driver.personal.firstName = ''
            this.driver.personal.lastName = ''
            this.driver.personal.email = ''
            this.driver.personal.phone = ''
            this.driver.personal.birthDate = null

            this.driver.address.country = null
            this.driver.address.city = ''
            this.driver.address.postalCode = ''
            this.driver.address.addressLine1 = ''
            this.driver.address.addressLine2 = ''

            this.driver.licence.licenceNumber = ''
            this.driver.licence.issuingCountry = null
            this.driver.licence.issueDate = null
            this.driver.licence.expiryDate = null
        },
        async setExtras(selectedExtras) {
            const availableExtras = await fetchExtras()
            const lookupStore = useBookingLookupStore()

            const extrasWithDetails = selectedExtras
                .map(extra => {
                    const extraData = availableExtras.data.data.find(item => item.id === extra.id)

                    if (!extraData) {
                        console.error(`Extra with ID ${extra.id} not found.`)
                        return null
                    }

                    return {
                        ...extraData,
                        quantity: extra.quantity,
                    }
                })
                .filter(extra => extra !== null)

            lookupStore.setExtras(extrasWithDetails)
        },
        async setInsurance(insurance) {
            const insurances = await fetchInsurances()
            const lookupStore = useBookingLookupStore()
            this.insuranceId = insurance

            const selectedInsurance = insurances.data.data.find(item => item.id === insurance)
            if (!selectedInsurance) {
                console.error(`Insurance with ID ${insurance} not found.`)
                return
            }

            lookupStore.setInsurance(selectedInsurance)
        },
    },
    persist: {
        key: 'booking',
        storage: localStorage,
    },
})
