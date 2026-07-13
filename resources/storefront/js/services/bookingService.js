import axios from 'axios'

export const getBookingData = ({ carId, pickUpLocationId, dropOffLocationId }) => {
    return axios.get('/api/storefront/booking', {
        params: { carId, pickUpLocationId, dropOffLocationId },
    })
}
