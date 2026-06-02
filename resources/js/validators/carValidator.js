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

    if (!values.category) {
        errors.category = [{ message: 'Please select a category.' }]
    }

    if (!values.body_type) {
        errors.body_type = [{ message: 'Please select a body type.' }]
    }

    if (!values.transmission) {
        errors.transmission = [{ message: 'Please select a transmission type.' }]
    }

    if (!values.fuel) {
        errors.fuel = [{ message: 'Please select a fuel type.' }]
    }

    if (!values.seats) {
        errors.seats = [{ message: 'Please select the number of seats.' }]
    }

    if (!values.doors) {
        errors.doors = [{ message: 'Please select the number of doors.' }]
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

    if (!values.milage) {
        errors.milage = [{ message: 'Please add milage.' }]
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
