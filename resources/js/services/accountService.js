import axios from 'axios'

export const fetchMe = () => {
    return axios.get(`/api/admin/account/me`)
}

export const updateMe = values => {
    return axios.put(`/api/admin/account/me`, values)
}

export const updatePassword = values => {
    return axios.put(`/api/admin/account/password`, values)
}
