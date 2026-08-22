import { fetchCustomerBookings } from '@storefront/services/authService'
import { ref } from 'vue'

export const useProfileBookings = () => {
    const bookings = ref([])

    const statusSeverity = status => {
        const severities = {
            pending: 'warn',
            confirmed: 'success',
            picked_up: 'info',
            returned: 'secondary',
            cancelled: 'danger',
        }

        return severities[status] ?? 'secondary'
    }

    const statusSeverityLabel = status => {
        const severities = {
            pending: 'Pending',
            confirmed: 'Confirmed',
            picked_up: 'Picked up',
            returned: 'Returned',
            cancelled: 'Cancelled',
        }

        return severities[status] ?? 'Pending'
    }

    const getCustomerBookings = async () => {
        try {
            const { data } = await fetchCustomerBookings()
            bookings.value = data
        } catch (error) {
            console.error(error)
        }
    }

    return {
        statusSeverityLabel,
        statusSeverity,
        getCustomerBookings,
        bookings,
    }
}
