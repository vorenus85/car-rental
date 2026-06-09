import axios from 'axios'

export const checkAuth = async () => {
    return await axios.get('/auth/check')
}

export const getCsrfCookie = async () => {
    return axios.get('/sanctum/csrf-cookie', { withCredentials: true })
}

export const fetchUser = async () => {
    return axios.get('/auth/me', { withCredentials: true })
}

export const doLogout = async () => {
    return axios.post('/auth/logout', null, { withCredentials: true })
}

export const doLogin = async (email, password) => {
    return await axios.post('/auth/login', { email, password }, { withCredentials: true })
}

export const forgotPassword = async email => {
    return axios.post('/auth/forgot-password', { email })
}

export const resetPassword = async values => {
    return axios.post('/auth/reset-password', values)
}
