export const personalValidator = ({ values }) => {
    const errors = {}
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/

    if (!values.firstName) {
        errors.firstName = [{ message: 'First name is required.' }]
    }

    if (!values.lastName) {
        errors.lastName = [{ message: 'Last name is required.' }]
    }

    if (!values.phone) {
        errors.phone = [{ message: 'Phone number is required.' }]
    }

    if (!values.birthDate) {
        errors.birthDate = [{ message: 'Birth date is required.' }]
    }

    if (!values.email) {
        errors.email = [{ message: 'Email is required.' }]
    } else if (!emailRegex.test(values.email)) {
        errors.email = [{ message: 'Invalid email address.' }]
    }

    return {
        values,
        errors,
    }
}
