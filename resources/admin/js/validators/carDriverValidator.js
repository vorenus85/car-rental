export const carDriverValidator = ({ values }) => {
    const errors = {}

    if (!values.firstName) {
        errors.firstName = [{ message: 'First name is required.' }]
    }

    if (!values.lastName) {
        errors.lastName = [{ message: 'Last name is required.' }]
    }

    if (!values.phone) {
        errors.phone = [{ message: 'Phone is required.' }]
    }

    if (!values.birthDate) {
        errors.birthDate = [{ message: 'Birth date is required.' }]
    }

    if (!values.licenceNumber) {
        errors.licenceNumber = [{ message: 'Licence number is required.' }]
    }

    if (!values.licenceCountry) {
        errors.licenceCountry = [{ message: 'Licence country is required.' }]
    }

    if (!values.licenceIssueDate) {
        errors.licenceIssueDate = [{ message: 'Licence issue date is required.' }]
    }

    if (!values.licenceExpiryDate) {
        errors.licenceExpiryDate = [{ message: 'Licence expiry date is required.' }]
    }

    return { values, errors }
}
