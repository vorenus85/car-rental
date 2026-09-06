import axios from 'axios'

export const fetchBookings = async () => {
    return axios.get('/api/admin/bookings')
}

export const fetchActiveRentals = async () => {
    return axios.get('/api/admin/bookings/active-rentals')
}

export const fetchUpcomingRentals = async () => {
    return axios.get('/api/admin/bookings/upcoming-rentals')
}

export const fetchPendingRentals = async () => {
    return axios.get('/api/admin/bookings/pending-rentals')
}

export const fetchOverdueRentals = async () => {
    return axios.get('/api/admin/bookings/overdue-rentals')
}
