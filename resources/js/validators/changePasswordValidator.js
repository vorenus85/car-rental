export const changePasswordValidator = ({ values }) => {
    const errors = {}

    if (!values.current_password) {
        errors.current_password = [{ message: 'Current password is required.' }]
    }

    if (!values.password) {
        errors.password = [{ message: 'Password is required.' }]
    } else if (values.password.length < 8) {
        errors.password = [{ message: 'Password must be at least 8 characters long.' }]
    }

    if (!values.password_confirmation) {
        errors.password_confirmation = [{ message: 'Password again is required.' }]
    } else if (values.password_confirmation.length < 8) {
        errors.password_confirmation = [
            { message: 'Password again must be at least 8 characters long.' },
        ]
    } else if (values.password !== values.password_confirmation) {
        errors.password_confirmation = [
            { message: 'The password field confirmation does not match.' },
        ]
    }

    return { values, errors }
}
