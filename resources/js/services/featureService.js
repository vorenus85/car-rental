export const fetchFeatures = () => {
    return axios.get('/api/admin/features')
}

export const fetchFeature = id => {
    return axios.get(`/api/admin/features/${id}`)
}

export const deleteFeatureById = id => {
    return axios.delete(`/api/admin/features/${id}`)
}

export const createFeature = values => {
    return axios.post('/api/admin/features', values)
}

export const updateFeatureById = (id, values) => {
    return axios.put(`/api/admin/features/${id}`, values)
}
