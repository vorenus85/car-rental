import { fetchBookings, fetchActiveRentals } from '@admin/services/bookingService'
import { ref } from 'vue'

export const useBooking = () => {
    const loading = ref(false)
    const bookings = ref([])
    const activeRentals = ref([])

    const getBookings = async () => {
        loading.value = true

        try {
            const { data } = await fetchBookings()
            bookings.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const getActiveRentals = async () => {
        loading.value = true

        try {
            const { data } = await fetchActiveRentals()
            activeRentals.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        getBookings,
        getActiveRentals,
        bookings,
        activeRentals,
        loading,
    }
}
