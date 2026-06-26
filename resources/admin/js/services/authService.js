import axios from 'axios'

export const checkAuth = async () => {
    return await axios.get('/admin/auth/check')
}

export const getCsrfCookie = async () => {
    return axios.get('/sanctum/csrf-cookie', { withCredentials: true })
}

export const fetchUser = async () => {
    return axios.get('/admin/auth/me', { withCredentials: true })
}

export const doLogout = async () => {
    return axios.post('/admin/auth/logout', null, { withCredentials: true })
}

export const doLogin = async (email, password) => {
    return await axios.post('/admin/auth/login', { email, password }, { withCredentials: true })
}

export const forgotPassword = async email => {
    return axios.post('/admin/auth/forgot-password', { email })
}

export const resetPassword = async values => {
    return axios.post('/admin/auth/reset-password', values)
}
