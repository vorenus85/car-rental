import { describe, it, expect } from 'vitest'

import { contactValidator } from '@storefront/validators/contactValidator'

describe('contactValidator', () => {
    it('returns no errors for valid values', () => {
        const result = contactValidator({
            values: {
                name: 'John Doe',
                email: 'john@example.com',
                phone: '+36 30 123 4567',
                subject: 'Reservation question',
                message: 'Hello, I would like to ask about a booking.',
            },
        })

        expect(result.errors).toEqual({})
    })

    it('requires the core fields', () => {
        const result = contactValidator({
            values: {},
        })

        expect(result.errors.name).toEqual([{ message: 'Name is required.' }])
        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
        expect(result.errors.subject).toEqual([{ message: 'Subject is required.' }])
        expect(result.errors.message).toEqual([{ message: 'Message is required.' }])
    })
})
