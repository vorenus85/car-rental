export const insuranceValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Insurance name is required.' }]
    }

    if (values.price === '' || values.price === null || values.price === undefined) {
        errors.price = [{ message: 'Price per day must be greater than 0.' }]
    }

    return {
        values,
        errors,
    }
}
