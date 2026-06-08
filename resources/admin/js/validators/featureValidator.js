export const featureValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Feature name is required.' }]
    }

    if (!values.category) {
        errors.category = [{ message: 'Feature category is required.' }]
    }

    return {
        values,
        errors,
    }
}
