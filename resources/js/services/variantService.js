export const fetchVariants = () => {
    return axios.get('/api/admin/variants')
}

export const fetchVariant = id => {
    return axios.get(`/api/admin/variants/${id}`)
}

export const deleteVariantById = id => {
    console.log('deleteVariantById', id)
    return axios.delete(`/api/admin/variants/${id}`)
}

export const createVariant = values => {
    return axios.post('/api/admin/variants', values)
}

export const updateVariantById = (id, values) => {
    return axios.put(`/api/admin/variants/${id}`, values)
}
