export const useAuth = () => {
    const loginValidator = ({ values }) => {
        const errors = {}
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/

        if (!values.email) {
            errors.email = [{ message: 'Email is required.' }]
        }

        if (!emailRegex.test(values.email)) {
            errors.email = [{ message: 'Invalid email address.' }]
        }

        if (!values.password) {
            errors.password = [{ message: 'Password is required.' }]
        }

        if (Object.keys(errors).length) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            })
        }

        return {
            values,
            errors,
        }
    }

    return { loginValidator }
}
