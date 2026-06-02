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

export const uploadCarImage = (file, onProgress) => {
    const formData = new FormData()
    formData.append('file', file)

    return axios.post('/api/admin/cars/image/upload', formData, {
        onUploadProgress: event => {
            if (!event.total || !onProgress) return
            onProgress(Math.round((event.loaded * 100) / event.total))
        },
    })
}

export const deleteCarImage = id => {
    return axios.delete(`/api/admin/cars/image/delete/${id}`)
}
