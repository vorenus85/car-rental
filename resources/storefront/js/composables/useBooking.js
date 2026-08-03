import { getDaysBetween } from '@storefront/utils.js'
import { useBookingStore } from '@storefront/stores/bookingStore'
import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'
import { getBookingData } from '@storefront/services/bookingService'
import { computed } from 'vue'

export const useBooking = () => {
    const bookingLookupStore = useBookingLookupStore()
    const bookingStore = useBookingStore()

    const maxBirthDate = new Date()
    maxBirthDate.setFullYear(maxBirthDate.getFullYear() - 25)

    const maxLicenceDate = new Date()
    maxLicenceDate.setFullYear(maxLicenceDate.getFullYear() - 2)

    const calcRentalPeriod = (pickUpDate, dropOffDate) => {
        const days = getDaysBetween(pickUpDate, dropOffDate)
        return days
    }

    const calcFee = ({ price, pickUpDate, dropOffDate }) => {
        const days = getDaysBetween(pickUpDate, dropOffDate)
        return days * price
    }

    const baseRentalFee = computed(() => {
        return calcFee({
            price: bookingLookupStore?.carData?.pricePerDay,
            pickUpDate: bookingLookupStore?.pickUpDate,
            dropOffDate: bookingLookupStore?.dropOffDate,
        })
    })

    const insuranceFee = computed(() => {
        return calcFee({
            price: bookingLookupStore?.insuranceData?.price,
            pickUpDate: bookingLookupStore?.pickUpDate,
            dropOffDate: bookingLookupStore?.dropOffDate,
        })
    })

    const extrasFee = computed(() => {
        let sum = 0

        bookingLookupStore?.extrasData.forEach(element => {
            sum +=
                element.quantity *
                calcFee({
                    price: element.price,
                    pickUpDate: bookingLookupStore?.pickUpDate,
                    dropOffDate: bookingLookupStore?.dropOffDate,
                })

            return sum
        })

        return sum
    })

    const bookingTotal = computed(() => {
        return baseRentalFee.value + insuranceFee.value + extrasFee.value
    })

    const loadBookingData = async params => {
        try {
            const { data } = await getBookingData(params)
            const { pickUpDate, pickUpTime, dropOffDate, dropOffTime } = bookingStore.getBookingData
            const carData = {
                id: data.car.id,
                name: data.car.name,
                pricePerDay: data.car.pricePerDay,
                imageUrl: data.car.imageUrl,
            }

            const pickUpLocation = {
                id: data.pickUpLocation.id,
                name: data.pickUpLocation.name,
                city: data.pickUpLocation.city,
            }
            const dropOffLocation = {
                id: data.dropOffLocation.id,
                name: data.dropOffLocation.name,
                city: data.dropOffLocation.city,
            }

            const bookingData = {
                carData,
                pickUpLocation,
                dropOffLocation,
                pickUpDate,
                pickUpTime,
                dropOffDate,
                dropOffTime,
            }
            bookingLookupStore.setBookingData(bookingData)
        } catch (error) {
            // console.error('Error loading booking data:', error)
            void error
        }
    }

    return {
        calcRentalPeriod,
        loadBookingData,
        calcFee,
        baseRentalFee,
        insuranceFee,
        extrasFee,
        bookingTotal,
        maxBirthDate,
        maxLicenceDate,
    }
}
