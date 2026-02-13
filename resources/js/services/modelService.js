export const fetchModels = () => {
    return axios.get('/api/admin/models')
}

export const fetchModel = id => {
    return axios.get(`/api/admin/models/${id}`)
}

export const deleteModelById = id => {
    return axios.delete(`/api/admin/models/${id}`)
}

export const createModel = values => {
    return axios.post('/api/admin/models', values)
}

export const updateModelById = (id, values) => {
    return axios.put(`/api/admin/models/${id}`, values)
}
