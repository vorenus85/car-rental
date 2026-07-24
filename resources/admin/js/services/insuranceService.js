import axios from 'axios'

export const fetchInsurances = () => {
    return axios.get('/api/admin/insurances')
}

export const fetchInsurance = id => {
    return axios.get(`/api/admin/insurances/${id}`)
}

export const deleteInsuranceById = id => {
    return axios.delete(`/api/admin/insurances/${id}`)
}

export const createInsurance = values => {
    return axios.post('/api/admin/insurances', values)
}

export const updateInsuranceById = (id, values) => {
    return axios.put(`/api/admin/insurances/${id}`, values)
}
