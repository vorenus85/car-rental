export const variantValidator = ({ values }) => {
    const errors = {}

    if (!values.name) {
        errors.name = [{ message: 'Please enter a variant name.' }]
    }

    if (!values.brand_id) {
        errors.brand_id = [{ message: 'Please select a brand.' }]
    }

    if (!values.model_id) {
        errors.model_id = [{ message: 'Please select a model.' }]
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

    if (values.seats === '' || values.seats === null || values.seats === undefined) {
        errors.seats = [{ message: 'Please enter the number of seats.' }]
    } else if (Number(values.seats) < 1) {
        errors.seats = [{ message: 'Seats must be minimum 1.' }]
    }

    if (values.doors === '' || values.doors === null || values.doors === undefined) {
        errors.doors = [{ message: 'Please enter the number of doors.' }]
    } else if (Number(values.doors) < 1) {
        errors.doors = [{ message: 'Doors must be minimum 1.' }]
    }

    if (
        values.luggage_count === '' ||
        values.luggage_count === null ||
        values.luggage_count === undefined
    ) {
        errors.luggage_count = [{ message: 'Please enter the number of luggages.' }]
    } else if (Number(values.luggage_count) < 1) {
        errors.luggage_count = [{ message: 'Luggages must be minimum 1.' }]
    }

    if (!values.range_km) {
        errors.range_km = [{ message: 'Please enter range.' }]
    }

    return {
        values,
        errors,
    }
}
