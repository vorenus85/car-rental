import axios from 'axios'

export const sendContactMessage = payload => {
    return axios.post('/api/storefront/contact', payload)
}
