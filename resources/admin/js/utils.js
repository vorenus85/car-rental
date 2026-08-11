import { countries } from 'countries-list'

export const countryOptions = Object.entries(countries)
    .map(([code, country]) => ({
        code,
        name: country.name,
    }))
    .sort((a, b) => a.name.localeCompare(b.name))

export const getCountryName = code => {
    return countries[code]?.name ?? ''
}

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
