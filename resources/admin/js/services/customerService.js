import axios from 'axios'

export const fetchCustomers = async (params = {}) => {
    return axios.get('/api/admin/customers', { params })
}

export const fetchCustomer = async (id, params = {}) => {
    return axios.get(`/api/admin/customers/${id}`, { params })
}

export const deleteCustomerById = id => {
    return axios.delete(`/api/admin/customers/${id}`)
}

export const createCustomer = values => {
    return axios.post('/api/admin/customers', values)
}

export const updateCustomerById = (id, values) => {
    return axios.put(`/api/admin/customers/${id}`, values)
}

export const toggleCustomerActive = id => {
    return axios.put(`/api/admin/customers/${id}/toggle-active`)
}

export const sendPasswordReset = id => {
    return axios.post(`/api/admin/customers/${id}/send-password-reset`)
}
