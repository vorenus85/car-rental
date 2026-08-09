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
