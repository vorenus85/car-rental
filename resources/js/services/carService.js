export const fetchCars = () => {
    return axios.get('/api/admin/cars')
}

export const fetchCar = id => {
    return axios.get(`/api/admin/cars/${id}`)
}

export const deleteCarById = id => {
    return axios.delete(`/api/admin/cars/${id}`)
}

export const createCar = values => {
    return axios.post('/api/admin/cars', values)
}

export const updateCarById = (id, values) => {
    return axios.put(`/api/admin/cars/${id}`, values)
}
