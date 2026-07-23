import axios from 'axios'

export const fetchExtras = () => {
    return axios.get('/api/admin/extras')
}

export const fetchExtra = id => {
    return axios.get(`/api/admin/extras/${id}`)
}

export const deleteExtraById = id => {
    return axios.delete(`/api/admin/extras/${id}`)
}

export const createExtra = values => {
    return axios.post('/api/admin/extras', values)
}

export const updateExtraById = (id, values) => {
    return axios.put(`/api/admin/extras/${id}`, values)
}
