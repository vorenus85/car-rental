import axios from 'axios'

export const fetchBookings = async () => {
    return axios.get('/api/admin/bookings')
}
