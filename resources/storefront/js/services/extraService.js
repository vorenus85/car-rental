import axios from 'axios'

export const fetchExtras = () => {
    return axios.get('/api/storefront/extras')
}
