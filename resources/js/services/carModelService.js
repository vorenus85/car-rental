export const fetchCarModels = () => {
    return axios.get('/api/admin/car-models')
}

export const fetchCarModel = id => {
    return axios.get(`/api/admin/car-models/${id}`)
}

export const deleteCarModelById = id => {
    return axios.delete(`/api/admin/car-models/${id}`)
}

export const createCarModel = values => {
    return axios.post('/api/admin/car-models', values)
}

export const updateCarModelById = (id, values) => {
    return axios.put(`/api/admin/car-models/${id}`, values)
}
