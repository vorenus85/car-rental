import axios from 'axios'

export const fetchInsurances = () => {
    return axios.get('/api/storefront/insurances')
}
