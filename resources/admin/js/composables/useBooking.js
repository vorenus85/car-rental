import { fetchBookings } from '@admin/services/bookingService'
import { ref } from 'vue'

export const useBooking = () => {
    const loading = ref(false)
    const bookings = ref([])

    const getBookings = async () => {
        loading.value = true

        try {
            loading.value = false
            const { data } = await fetchBookings()
            bookings.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = true
        }
    }

    return {
        getBookings,
        bookings,
    }
}
