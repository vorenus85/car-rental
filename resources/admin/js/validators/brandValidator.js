export const brandValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Brand name is required.' }]
    }

    return {
        values,
        errors,
    }
}
