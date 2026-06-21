import axios from 'axios'

export const fetchRandomCars = () => {
    return axios.get('/api/storefront/cars/randoms')
}

export const fetchSimilarCars = id => {
    return axios.get(`/api/storefront/cars/similars/${id}`)
}

export const fetchCars = params => {
    return axios.get('/api/storefront/cars/', {
        params,
    })
}

export const fetchCar = id => {
    return axios.get(`/api/storefront/cars/${id}`)
}
