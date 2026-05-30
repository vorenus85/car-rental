export const userValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Name is required.' }]
    }

    if (!values.email) {
        errors.email = [{ message: 'Email is required.' }]
    } else if (!/\S+@\S+\.\S+/.test(values.email)) {
        errors.email = [{ message: 'Invalid email address.' }]
    }

    return { values, errors }
}
