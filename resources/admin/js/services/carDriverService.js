import axios from 'axios'

export const fetchCarDrivers = async (params = {}) => {
    return axios.get('/api/admin/car-drivers', { params })
}

export const fetchCarDriver = id => {
    return axios.get(`/api/admin/car-drivers/${id}`)
}

export const deleteCarDriverById = id => {
    return axios.delete(`/api/admin/car-drivers/${id}`)
}

export const createCarDriver = values => {
    return axios.post('/api/admin/car-drivers', values)
}

export const updateCarDriverById = (id, values) => {
    return axios.put(`/api/admin/car-drivers/${id}`, values)
}
