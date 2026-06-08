import { describe, it, expect } from 'vitest'
import { variantValidator } from '@admin/validators/variantValidator'

describe('variantValidator', () => {
    const validValues = {
        name: 'Corolla Comfort',
        brand_id: 1,
        model_id: 1,
        category: 'economy',
        body_type: 'sedan',
        transmission: 'automatic',
        fuel: 'hybrid',
        seats: 5,
        doors: 4,
    }

    it('returns no errors for valid values', () => {
        const result = variantValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('requires name', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                name: '',
            },
        })

        expect(result.errors.name).toEqual([{ message: 'Please enter a variant name.' }])
    })

    it('requires brand', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                brand_id: null,
            },
        })

        expect(result.errors.brand_id).toEqual([{ message: 'Please select a brand.' }])
    })

    it('requires model', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                model_id: null,
            },
        })

        expect(result.errors.model_id).toEqual([{ message: 'Please select a model.' }])
    })

    it('requires category', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                category: '',
            },
        })

        expect(result.errors.category).toEqual([{ message: 'Please select a category.' }])
    })

    it('requires body type', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                body_type: '',
            },
        })

        expect(result.errors.body_type).toEqual([{ message: 'Please select a body type.' }])
    })

    it('requires transmission', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                transmission: '',
            },
        })

        expect(result.errors.transmission).toEqual([
            { message: 'Please select a transmission type.' },
        ])
    })

    it('requires fuel', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                fuel: '',
            },
        })

        expect(result.errors.fuel).toEqual([{ message: 'Please select a fuel type.' }])
    })

    it('requires seats', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                seats: '',
            },
        })

        expect(result.errors.seats).toEqual([{ message: 'Please enter the number of seats.' }])
    })

    it('requires seats to be at least 1', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                seats: 0,
            },
        })

        expect(result.errors.seats).toEqual([{ message: 'Seats must be minimum 1.' }])
    })

    it('requires doors', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                doors: '',
            },
        })

        expect(result.errors.doors).toEqual([{ message: 'Please enter the number of doors.' }])
    })

    it('requires doors to be at least 1', () => {
        const result = variantValidator({
            values: {
                ...validValues,
                doors: 0,
            },
        })

        expect(result.errors.doors).toEqual([{ message: 'Doors must be minimum 1.' }])
    })
})
