import { defineStore } from 'pinia'
import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'
import { extras as availableExtras } from '@storefront/data/extras.js'
import { insurances } from '@storefront/data/insurances.js'

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
        insuranceId: 0,
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
    },
    actions: {
        setBookingData(data) {
            this.carId = data.carId
            this.pickUpLocationId = data.pickUpLocationId
            this.dropOffLocationId = data.dropOffLocationId
            this.pickUpDate = data.pickUpDate
            this.pickUpTime = data.pickUpTime
            this.dropOffDate = data.dropOffDate
            this.dropOffTime = data.dropOffTime
        },
        setExtras(selectedExtras) {
            const lookupStore = useBookingLookupStore()

            this.extras = selectedExtras

            const extrasWithDetails = selectedExtras
                .map(extra => {
                    const extraData = availableExtras.find(item => item.id === extra.id)

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
        setInsurance(insurance) {
            const lookupStore = useBookingLookupStore()
            this.insuranceId = insurance

            const selectedInsurance = insurances.find(item => item.id === insurance)
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
