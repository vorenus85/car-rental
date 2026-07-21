export const addressValidator = ({ values }) => {
    const errors = {}

    if (!values.country) {
        errors.country = [{ message: 'Country is required.' }]
    }

    if (!values.city) {
        errors.city = [{ message: 'City is required.' }]
    }

    if (!values.postalCode) {
        errors.postalCode = [{ message: 'Postal code is required.' }]
    }

    if (!values.addressLine1) {
        errors.addressLine1 = [{ message: 'Address line 1 is required.' }]
    }

    return {
        values,
        errors,
    }
}
