import { ref, computed } from 'vue'
import { getBookingOrder } from '@storefront/services/bookingService'
import { formatDate, formatTime } from '@storefront/utils.js'

export const useBookingOrder = () => {
    const bookingOrderInfo = ref({})
    const customerEmail = computed(() => {
        return bookingOrderInfo.value?.customer?.email || 'your email address'
    })
    const bookingNumber = computed(() => {
        return bookingOrderInfo.value?.booking_number || 'Booking reference'
    })
    const pickUpLabel = computed(() => {
        const pickUpAt = bookingOrderInfo.value?.pickup_at
        if (!pickUpAt) {
            return 'Pick-up details'
        }

        return `${formatDate(new Date(pickUpAt), 'yyyy.MM.dd')} • ${formatTime(new Date(pickUpAt))}`
    })
    const dropOffLabel = computed(() => {
        const dropOffAt = bookingOrderInfo.value?.dropoff_at
        if (!dropOffAt) {
            return 'Drop-off details'
        }

        return `${formatDate(new Date(dropOffAt), 'yyyy.MM.dd')} • ${formatTime(new Date(dropOffAt))}`
    })
    const pickUpLocation = ''
    const dropOffLocation = ''
    const vehicle = ''
    const bookingTotal = computed(() => {
        return Math.trunc(Number(bookingOrderInfo.value?.total_amount ?? 0))
    })

    const loadBookingOrder = async publicId => {
        try {
            const { data } = await getBookingOrder({ publicId })
            console.log(data)
            bookingOrderInfo.value = data
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
