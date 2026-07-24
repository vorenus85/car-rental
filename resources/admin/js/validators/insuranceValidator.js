export const insuranceValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Insurance name is required.' }]
    }

    if (!values.price) {
        errors.price = [{ message: 'Insurance price is required.' }]
    }

    return {
        values,
        errors,
    }
}
