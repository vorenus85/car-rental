import axios from 'axios'

export const fetchUsers = async (params = {}) => {
    return axios.get('/api/admin/users', { params })
}

export const fetchUser = async (id, params = {}) => {
    return axios.get(`/api/admin/users/${id}`, { params })
}

export const deleteUserById = id => {
    return axios.delete(`/api/admin/users/${id}`)
}

export const createUser = values => {
    return axios.post('/api/admin/users', values)
}

export const updateUserById = (id, values) => {
    return axios.put(`/api/admin/users/${id}`, values)
}

export const toggleUserActive = id => {
    return axios.put(`/api/admin/users/${id}/toggle-active`)
}
