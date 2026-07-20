export const drivingLicenceValidator = ({ values }) => {
    const errors = {}

    if (!values.licenceNumber) {
        errors.licenceNumber = [{ message: 'Licence number is required.' }]
    }

    if (!values.issuingCountry) {
        errors.issuingCountry = [{ message: 'Issuing Country is required.' }]
    }

    if (!values.issueDate) {
        errors.issueDate = [{ message: 'Issue date is required.' }]
    }

    if (!values.expiryDate) {
        errors.expiryDate = [{ message: 'Expiry date is required.' }]
    }

    return {
        values,
        errors,
    }
}
