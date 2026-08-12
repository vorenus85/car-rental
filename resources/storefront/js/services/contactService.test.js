import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import { sendContactMessage } from '@storefront/services/contactService'

vi.mock('axios')

describe('contactService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should call POST /api/storefront/contact with payload', async () => {
        const payload = {
            name: 'John Doe',
            email: 'john@example.com',
            phone: '+36 30 123 4567',
            subject: 'Reservation question',
            message: 'Hello, I would like to ask about a booking.',
        }

        axios.post.mockResolvedValue({
            data: {
                message: 'Thanks! Your message has been sent.',
            },
        })

        const response = await sendContactMessage(payload)

        expect(axios.post).toHaveBeenCalledWith('/api/storefront/contact', payload)
        expect(response.data.message).toBe('Thanks! Your message has been sent.')
    })
})
