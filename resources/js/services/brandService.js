export const fetchBrands = () => {
    return axios.get('/api/admin/brands')
}

export const fetchBrand = id => {
    return axios.get(`/api/admin/brands/${id}`)
}

export const deleteBrandById = id => {
    return axios.delete(`/api/admin/brands/${id}`)
}

export const createBrand = values => {
    return axios.post('/api/admin/brands', values)
}

export const updateBrandById = (id, values) => {
    return axios.put(`/api/admin/brands/${id}`, values)
}

export const uploadBrandImage = (file, onProgress) => {
    const formData = new FormData()
    formData.append('file', file)

    return axios.post('/api/admin/brands/image/upload', formData, {
        onUploadProgress: event => {
            if (!event.total || !onProgress) return
            onProgress(Math.round((event.loaded * 100) / event.total))
        },
    })
}

export const deleteBrandImage = id => {
    return axios.delete(`/api/admin/brands/image/delete/${id}`)
}
