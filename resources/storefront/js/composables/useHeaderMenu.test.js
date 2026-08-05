import { describe, it, expect } from 'vitest'

import { useHeaderMenu } from '@storefront/composables/useHeaderMenu'

describe('useHeaderMenu', () => {
    it('should expose the header menu items', () => {
        const { headerMenu } = useHeaderMenu()

        expect(headerMenu).toEqual([
            { id: 1, title: 'Home', path: '/', name: 'home' },
            { id: 2, title: 'Fleet', path: '/fleet', name: 'fleet' },
            { id: 3, title: 'Services', path: '/services', name: 'services' },
            { id: 4, title: 'Contact', path: '/contact', name: 'contact' },
        ])
    })
})
