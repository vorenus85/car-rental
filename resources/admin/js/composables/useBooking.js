import {
    fetchBookings,
    fetchActiveRentals,
    fetchUpcomingRentals,
    fetchPendingRentals,
    fetchOverdueRentals,
} from '@admin/services/bookingService'
import { ref } from 'vue'
import { useRoute } from 'vue-router'

export const useBooking = () => {
    const loading = ref(false)
    const route = useRoute()
    const bookings = ref([])
    const activeRentals = ref([])
    const upcomingRentals = ref([])
    const pendingRentals = ref([])
    const overdueRentals = ref([])

    const getBookings = async (params = route.query ?? {}) => {
        loading.value = true

        try {
            const { data } = await fetchBookings({ ...params })
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

    const getOverdueRentals = async () => {
        loading.value = true

        try {
            const { data } = await fetchOverdueRentals()
            overdueRentals.value = data
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
        getOverdueRentals,
        getPendingRentals,
        bookings,
        activeRentals,
        upcomingRentals,
        pendingRentals,
        overdueRentals,
        loading,
    }
}
