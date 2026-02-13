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
