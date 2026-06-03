import { carValidator } from '@/validators/carValidator'
import { describe, it, expect } from 'vitest'

describe('carValidator', () => {
    const validValues = {
        brand_id: 1,
        model_id: 1,
        variant_id: 1,

        licence_plate: 'ABC-123',
        color: 'red',
        production_year: 2020,
        mileage: 10000,
        price_per_day: 50,
        status: 'available',
    }

    it('returns no errors for valid values', () => {
        const result = carValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('requires brand_id', () => {
        const result = carValidator({
            values: {
                ...validValues,
                brand_id: '',
            },
        })

        expect(result.errors.brand_id).toEqual([{ message: 'Please select a brand.' }])
    })

    it('requires model_id', () => {
        const result = carValidator({
            values: {
                ...validValues,
                model_id: '',
            },
        })

        expect(result.errors.model_id).toEqual([{ message: 'Please select a model.' }])
    })

    it('requires variant_id', () => {
        const result = carValidator({
            values: {
                ...validValues,
                variant_id: '',
            },
        })

        expect(result.errors.variant_id).toEqual([{ message: 'Please select a variant.' }])
    })

    it('requires licence_plate', () => {
        const result = carValidator({
            values: {
                ...validValues,
                licence_plate: '',
            },
        })

        expect(result.errors.licence_plate).toEqual([
            { message: 'Please add licence plate number.' },
        ])
    })

    it('requires color', () => {
        const result = carValidator({
            values: {
                ...validValues,
                color: '',
            },
        })

        expect(result.errors.color).toEqual([{ message: 'Please select a color.' }])
    })

    it('requires production_year', () => {
        const result = carValidator({
            values: {
                ...validValues,
                production_year: '',
            },
        })

        expect(result.errors.production_year).toEqual([{ message: 'Please add production year.' }])
    })

    it('requires mileage', () => {
        const result = carValidator({
            values: {
                ...validValues,
                mileage: '',
            },
        })

        expect(result.errors.mileage).toEqual([{ message: 'Please add mileage.' }])
    })

    it('requires price_per_day', () => {
        const result = carValidator({
            values: {
                ...validValues,
                price_per_day: '',
            },
        })

        expect(result.errors.price_per_day).toEqual([{ message: 'Please add price per day.' }])
    })

    it('requires status', () => {
        const result = carValidator({
            values: {
                ...validValues,
                status: '',
            },
        })

        expect(result.errors.status).toEqual([{ message: 'Please select a status.' }])
    })
})
