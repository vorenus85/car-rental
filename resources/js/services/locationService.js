import axios from 'axios'

export const fetchLocations = () => {
    return axios.get('/api/admin/locations')
}

export const fetchLocationsMinimal = () => {
    return axios.get('/api/admin/locations/options')
}

export const fetchLocation = id => {
    return axios.get(`/api/admin/locations/${id}`)
}

export const deleteLocationById = id => {
    return axios.delete(`/api/admin/locations/${id}`)
}

export const createLocation = values => {
    return axios.post('/api/admin/locations', values)
}

export const updateLocationById = (id, values) => {
    return axios.put(`/api/admin/locations/${id}`, values)
}

export const toggleLocationActive = id => {
    return axios.put(`/api/admin/locations/${id}/toggle-active`)
}
