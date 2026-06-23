import axios from 'axios'

export const fetchBrands = () => {
    return axios.get('/api/storefront/brands')
}
