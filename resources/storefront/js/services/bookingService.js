import axios from 'axios'

export const getBookingData = ({ carId, pickUpLocationId, dropOffLocationId }) => {
    return axios.get('/api/storefront/booking', {
        params: { carId, pickUpLocationId, dropOffLocationId },
    })
}

export const createBooking = payload => {
    return axios.post('/api/storefront/booking', payload)
}
