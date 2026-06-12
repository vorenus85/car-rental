import axios from 'axios'

export const fetchRandomCars = () => {
    return axios.get('/api/storefront/cars/random-available')
}
