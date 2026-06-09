export const carModelValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Car model name is required.' }]
    }

    if (!values.brand_id) {
        errors.brand_id = [{ message: 'Brand is required.' }]
    }

    return {
        values,
        errors,
    }
}
