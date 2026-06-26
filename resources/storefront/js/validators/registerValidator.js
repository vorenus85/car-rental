export const registerValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Name is required.' }]
    }

    if (!values.email) {
        errors.email = [{ message: 'Email is required.' }]
    } else if (!/\S+@\S+\.\S+/.test(values.email)) {
        errors.email = [{ message: 'Email is invalid.' }]
    }

    if (!values.password) {
        errors.password = [{ message: 'Password is required.' }]
    } else if (values.password.length < 8) {
        errors.password = [{ message: 'Password must be at least 8 characters long.' }]
    }

    if (!values.password_confirmation) {
        errors.password_confirmation = [{ message: 'Password again is required.' }]
    } else if (values.password.length < 8) {
        errors.password_confirmation = [
            { message: 'Password again must be at least 8 characters long.' },
        ]
    }

    if (values.password !== values.password_confirmation) {
        errors.password_confirmation = [
            { message: 'The password field confirmation does not match.' },
        ]
    }

    return { values, errors }
}
