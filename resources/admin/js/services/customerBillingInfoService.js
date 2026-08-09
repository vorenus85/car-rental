import axios from 'axios'

export const fetchCustomerBillingInfo = async (id, params = {}) => {
    return axios.get(`/api/admin/customers/${id}/billing`, { params })
}

export const updateCustomerBillingInfoById = (id, values) => {
    return axios.post(`/api/admin/customers/${id}/billing`, values)
}
