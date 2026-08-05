import { describe, it, expect, vi, beforeEach, afterEach } from 'vitest'

import { useRentalSearch } from '@storefront/composables/useRentalSearch'

let currentRoute

const localDateKey = date => {
    return [
        date.getFullYear(),
        String(date.getMonth() + 1).padStart(2, '0'),
        String(date.getDate()).padStart(2, '0'),
    ].join('-')
}

vi.mock('vue-router', () => ({
    useRoute: () => currentRoute,
}))

describe('useRentalSearch', () => {
    beforeEach(() => {
        vi.useFakeTimers()
        vi.setSystemTime(new Date('2026-08-05T12:00:00.000Z'))

        currentRoute = {
            query: {},
        }
    })

    afterEach(() => {
        vi.useRealTimers()
        vi.clearAllMocks()
    })

    it('should expose default rental search state and time options', () => {
        const {
            minPickUpDate,
            defaultPickUpDate,
            minDropOffDate,
            defaultDropOffDate,
            searchParams,
            timeOptions,
        } = useRentalSearch()

        expect(defaultPickUpDate).toBeInstanceOf(Date)
        expect(localDateKey(defaultPickUpDate)).toBe('2026-08-05')

        expect(minPickUpDate).toBeInstanceOf(Date)
        expect(localDateKey(minPickUpDate)).toBe('2026-08-05')

        expect(defaultDropOffDate.value).toBeInstanceOf(Date)
        expect(defaultDropOffDate.value.getHours()).toBe(0)
        expect(localDateKey(defaultDropOffDate.value)).toBe('2026-08-08')

        expect(localDateKey(minDropOffDate)).toBe('2026-08-06')

        expect(searchParams.pickUpLocation).toBeNull()
        expect(searchParams.dropOffLocation).toBeNull()
        expect(searchParams.pickUpTime).toBe('10:00')
        expect(searchParams.dropOffTime).toBe('20:00')

        expect(timeOptions).toHaveLength(21)
        expect(timeOptions[0]).toEqual({ label: '10:00', value: '10:00' })
        expect(timeOptions[timeOptions.length - 1]).toEqual({ label: '20:00', value: '20:00' })
    })

    it('should hydrate search params from query', () => {
        currentRoute = {
            query: {
                pickUpDate: '2026-08-10',
                dropOffDate: '2026-08-15',
                pickUpLocation: '3',
                dropOffLocation: '7',
            },
        }

        const { searchParams, hydrateRentalSearchFromQuery } = useRentalSearch()

        hydrateRentalSearchFromQuery()

        expect(localDateKey(searchParams.pickUpDate)).toBe('2026-08-10')
        expect(localDateKey(searchParams.dropOffDate)).toBe('2026-08-15')
        expect(searchParams.pickUpLocation).toBe(3)
        expect(searchParams.dropOffLocation).toBe(7)
    })
})
