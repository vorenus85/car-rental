export const contactValidator = ({ values }) => {
    const errors = {}

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/

    if (!values.name) {
        errors.name = [{ message: 'Name is required.' }]
    } else if (values.name.length > 120) {
        errors.name = [{ message: 'Name must not exceed 120 characters.' }]
    }

    if (!values.email) {
        errors.email = [{ message: 'Email is required.' }]
    } else if (!emailRegex.test(values.email)) {
        errors.email = [{ message: 'Invalid email address.' }]
    }

    if (values.phone && values.phone.length > 30) {
        errors.phone = [{ message: 'Phone number must not exceed 30 characters.' }]
    }

    if (!values.subject) {
        errors.subject = [{ message: 'Subject is required.' }]
    } else if (values.subject.length > 160) {
        errors.subject = [{ message: 'Subject must not exceed 160 characters.' }]
    }

    if (!values.message) {
        errors.message = [{ message: 'Message is required.' }]
    } else if (values.message.length > 5000) {
        errors.message = [{ message: 'Message must not exceed 5000 characters.' }]
    }

    return {
        errors,
        values,
    }
}
