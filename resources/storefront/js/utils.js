import { countries } from 'countries-list'

export const formatDate = (date, format = 'yyyy-MM-dd') => {
    const year = date.getFullYear()
    const month = String(date.getMonth() + 1).padStart(2, '0')
    const day = String(date.getDate()).padStart(2, '0')

    let result = ''
    if (format === 'yyyy.MM.dd') {
        result = `${year}.${month}.${day}`
    } else {
        result = `${year}-${month}-${day}`
    }

    return result
}

export const formatTime = date => {
    const hours = String(date.getHours()).padStart(2, '0')
    const minutes = String(date.getMinutes()).padStart(2, '0')

    return `${hours}:${minutes}`
}

export const getDaysBetween = (start, end) => {
    const startDate = new Date(start)
    startDate.setHours(0, 0, 0, 0)
    const endDate = new Date(end)
    endDate.setHours(0, 0, 0, 0)

    const diffTime = endDate.getTime() - startDate.getTime()

    return Math.ceil(diffTime / (1000 * 60 * 60 * 24))
}

export const getDayName = date => {
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
    return days[date.getDay()]
}

export const countryOptions = Object.entries(countries)
    .map(([code, country]) => ({
        code,
        name: country.name,
    }))
    .sort((a, b) => a.name.localeCompare(b.name))

export const getCountryName = code => {
    return countries[code]?.name ?? ''
}
