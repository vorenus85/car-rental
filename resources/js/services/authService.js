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
