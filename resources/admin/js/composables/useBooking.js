import {
    fetchBookings,
    fetchActiveRentals,
    fetchUpcomingRentals,
    fetchPendingRentals,
} from '@admin/services/bookingService'
import { ref } from 'vue'

export const useBooking = () => {
    const loading = ref(false)
    const bookings = ref([])
    const activeRentals = ref([])
    const upcomingRentals = ref([])
    const pendingRentals = ref([])

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

    const getUpcomingRentals = async () => {
        loading.value = true

        try {
            const { data } = await fetchUpcomingRentals()
            upcomingRentals.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const getPendingRentals = async () => {
        loading.value = true

        try {
            const { data } = await fetchPendingRentals()
            pendingRentals.value = data
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
        getUpcomingRentals,
        getPendingRentals,
        bookings,
        activeRentals,
        upcomingRentals,
        pendingRentals,
        loading,
    }
}
