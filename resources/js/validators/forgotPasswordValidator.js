export const forgotPasswordValidator = ({ values }) => {
    const errors = {}
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/

    if (!values.email) {
        errors.email = [{ message: 'Email is required.' }]
    } else if (!emailRegex.test(values.email)) {
        errors.email = [{ message: 'Invalid email address.' }]
    }

    return {
        errors,
        values,
    }
}
