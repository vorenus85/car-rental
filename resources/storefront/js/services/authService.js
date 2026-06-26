import axios from 'axios'

export const checkAuth = async () => {
    return await axios.get('/storefront/auth/check')
}

export const getCsrfCookie = async () => {
    return axios.get('/sanctum/csrf-cookie', { withCredentials: true })
}

export const fetchUser = async () => {
    return axios.get('/storefront/auth/me', { withCredentials: true })
}

export const doRegister = async () => {
    return axios.post('/storefront/auth/register', null)
}

export const doLogout = async () => {
    return axios.post('/storefront/auth/logout', null, { withCredentials: true })
}

export const doLogin = async (email, password) => {
    return await axios.post(
        '/storefront/auth/login',
        { email, password },
        { withCredentials: true }
    )
}

export const forgotPassword = async email => {
    return axios.post('/storefront/auth/forgot-password', { email })
}

export const resetPassword = async values => {
    return axios.post('/storefront/auth/reset-password', values)
}
