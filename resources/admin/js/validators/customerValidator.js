export const customerValidator = ({ values }) => {
    const errors = {}

    if (!values.firstName) {
        errors.firstName = [{ message: 'First name is required.' }]
    }

    if (!values.lastName) {
        errors.lastName = [{ message: 'Last name is required.' }]
    }

    if (!values.email) {
        errors.email = [{ message: 'Email is required.' }]
    } else if (!/\S+@\S+\.\S+/.test(values.email)) {
        errors.email = [{ message: 'Invalid email address.' }]
    }

    return { values, errors }
}
