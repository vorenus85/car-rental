export const billingInfoValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Name is required.' }]
    }

    if (!values.country) {
        errors.country = [{ message: 'Country is required.' }]
    }

    if (!values.postcode) {
        errors.postcode = [{ message: 'Postcode is required.' }]
    }

    if (!values.city) {
        errors.city = [{ message: 'City is required.' }]
    }

    if (!values.address) {
        errors.address = [{ message: 'Address is required.' }]
    }

    return {
        values,
        errors,
    }
}
