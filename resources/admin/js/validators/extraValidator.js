export const extraValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Extra name is required.' }]
    }

    if (!values.price) {
        errors.price = [{ message: 'Extra price is required.' }]
    }

    if (!values.maxQuantity) {
        errors.maxQuantity = [{ message: 'Max quantity is required.' }]
    }

    return {
        values,
        errors,
    }
}
