import { ref, computed } from 'vue'
import { getBookingOrder } from '@storefront/services/bookingService'
import { formatDate, formatTime } from '@storefront/utils.js'

export const useBookingOrder = () => {
    const bookingOrderInfo = ref({})
    const customerEmail = computed(() => {
        return bookingOrderInfo.value?.customerEmail || 'your email address'
    })
    const bookingNumber = computed(() => {
        return bookingOrderInfo.value?.bookingNumber || 'Booking reference'
    })
    const pickUpLabel = computed(() => {
        const pickUpAt = bookingOrderInfo.value?.pickupAt
        if (!pickUpAt) {
            return 'Pick-up details'
        }

        return `${formatDate(new Date(pickUpAt), 'yyyy.MM.dd')} • ${formatTime(new Date(pickUpAt))}`
    })
    const dropOffLabel = computed(() => {
        const dropOffAt = bookingOrderInfo.value?.dropoffAt
        if (!dropOffAt) {
            return 'Drop-off details'
        }

        return `${formatDate(new Date(dropOffAt), 'yyyy.MM.dd')} • ${formatTime(new Date(dropOffAt))}`
    })
    const pickUpLocation = computed(() => {
        if (!bookingOrderInfo.value?.pickUpCity) {
            return 'Pick-up location'
        }
        return `${bookingOrderInfo.value?.pickUpCity}, ${bookingOrderInfo.value?.pickUpLocation}`
    })
    const dropOffLocation = computed(() => {
        if (!bookingOrderInfo.value?.dropOffCity) {
            return 'Drop-off location'
        }
        return `${bookingOrderInfo.value?.dropOffCity}, ${bookingOrderInfo.value?.dropOffLocation}`
    })
    const vehicle = computed(() => {
        return bookingOrderInfo.value?.vehicle || 'Vehicle'
    })
    const bookingTotal = computed(() => {
        return Math.trunc(Number(bookingOrderInfo.value?.bookingTotal ?? 0))
    })

    const loadBookingOrder = async publicId => {
        try {
            const { data } = await getBookingOrder({ publicId })
            console.log(data)
            bookingOrderInfo.value = data.data
        } catch (error) {
            console.error('Error loading booking order:', error)
        }
    }

    return {
        loadBookingOrder,
        vehicle,
        bookingNumber,
        customerEmail,
        pickUpLabel,
        dropOffLabel,
        pickUpLocation,
        dropOffLocation,
        bookingTotal,
    }
}
