export const fetchColors = () => {
    return axios.get('/api/admin/colors')
}

export const fetchColor = id => {
    return axios.get(`/api/admin/colors/${id}`)
}

export const deleteColorById = id => {
    return axios.delete(`/api/admin/colors/${id}`)
}

export const createColor = values => {
    return axios.post('/api/admin/colors', values)
}

export const updateColorById = (id, values) => {
    return axios.put(`/api/admin/colors/${id}`, values)
}
