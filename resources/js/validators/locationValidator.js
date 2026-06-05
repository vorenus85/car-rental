export const locationValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Location name is required.' }]
    }

    if (!values.city_country) {
        errors.city_country = [{ message: 'City and Country is required.' }]
    }

    if (!values.address) {
        errors.address = [{ message: 'Address is required.' }]
    }

    if (!values.type) {
        errors.type = [{ message: 'Type is required.' }]
    }

    if (!values.phone) {
        errors.phone = [{ message: 'Phone is required.' }]
    }

    if (!values.email) {
        errors.email = [{ message: 'Email is required.' }]
    } else if (!/\S+@\S+\.\S+/.test(values.email)) {
        errors.email = [{ message: 'Invalid email address.' }]
    }

    return {
        values,
        errors,
    }
}
