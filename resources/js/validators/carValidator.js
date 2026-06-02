export const carValidator = ({ values }) => {
    const errors = {}

    if (!values.brand_id) {
        errors.brand_id = [{ message: 'Please select a brand.' }]
    }

    if (!values.model_id) {
        errors.model_id = [{ message: 'Please select a model.' }]
    }

    if (!values.variant_id) {
        errors.variant_id = [{ message: 'Please select a variant.' }]
    }

    if (!values.licence_plate) {
        errors.licence_plate = [{ message: 'Please add licence plate number.' }]
    }

    if (!values.color) {
        errors.color = [{ message: 'Please select a color.' }]
    }

    if (!values.production_year) {
        errors.production_year = [{ message: 'Please add production year.' }]
    }

    if (!values.mileage) {
        errors.mileage = [{ message: 'Please add mileage.' }]
    }

    if (!values.price_per_day) {
        errors.price_per_day = [{ message: 'Please add price per day.' }]
    }

    if (!values.status) {
        errors.status = [{ message: 'Please select a status.' }]
    }

    return {
        values,
        errors,
    }
}
