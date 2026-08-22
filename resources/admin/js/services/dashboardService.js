import axios from 'axios'

export const fetchAvailableCarsKpi = async () => {
    return axios.get('/api/admin/dashboard/available-cars')
}

export const fetchTodayDropoffsKpi = async () => {
    return axios.get('/api/admin/dashboard/today-dropoffs')
}
