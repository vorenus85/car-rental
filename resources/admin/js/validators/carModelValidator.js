export const carModelValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Car model name is required.' }]
    }

    if (!values.brandId) {
        errors.brandId = [{ message: 'Brand is required.' }]
    }

    return {
        values,
        errors,
    }
}
