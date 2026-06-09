export const loginValidator = ({ values }) => {
    const errors = {}
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/

    if (!values.email) {
        errors.email = [{ message: 'Email is required.' }]
    } else if (!emailRegex.test(values.email)) {
        errors.email = [{ message: 'Invalid email address.' }]
    }

    if (!values.password) {
        errors.password = [{ message: 'Password is required.' }]
    }

    return {
        values,
        errors,
    }
}
