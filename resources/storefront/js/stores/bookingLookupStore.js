import { defineStore } from 'pinia'

export const useBookingLookupStore = defineStore('bookingLookup', {
    state: () => ({
        carData: null,
        pickUpLocation: null,
        dropOffLocation: null,
        pickUpDate: null,
        pickUpTime: null,
        dropOffDate: null,
        dropOffTime: null,
        extrasData: [],
        insuranceData: 0,
    }),
    actions: {
        setBookingData(data) {
            this.carData = data.carData
            this.pickUpLocation = data.pickUpLocation
            this.dropOffLocation = data.dropOffLocation
            this.pickUpDate = data.pickUpDate
            this.pickUpTime = data.pickUpTime
            this.dropOffDate = data.dropOffDate
            this.dropOffTime = data.dropOffTime
        },
        setExtras(extras) {
            this.extrasData = extras
        },
        setInsurance(insurance) {
            this.insuranceData = insurance
        },
        clearBookingData() {
            this.carData = null
            this.pickUpLocation = null
            this.dropOffLocation = null
            this.pickUpDate = null
            this.pickUpTime = null
            this.dropOffDate = null
            this.dropOffTime = null
            this.extrasData = []
            this.insuranceData = 0
        },
    },
})
