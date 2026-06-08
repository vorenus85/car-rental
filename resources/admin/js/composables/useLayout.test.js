import { describe, it, expect, vi } from 'vitest'
import { mount } from '@vue/test-utils'
import { defineComponent } from 'vue'
import { useLayout } from './useLayout'

describe('useLayout', () => {
    it('sets isMobile based on window width', () => {
        Object.defineProperty(window, 'innerWidth', {
            writable: true,
            configurable: true,
            value: 800,
        })

        const { isMobile } = useLayout()

        expect(isMobile.value).toBe(true)
    })

    it('toggles dark mode without view transition support', () => {
        document.startViewTransition = undefined

        const classToggleSpy = vi.spyOn(document.documentElement.classList, 'toggle')

        const { toggleDarkMode, darkTheme } = useLayout()

        toggleDarkMode()

        expect(darkTheme.value).toBe(true)
        expect(classToggleSpy).toHaveBeenCalledWith('app-dark')
    })

    it('uses startViewTransition when available', () => {
        const mockTransition = vi.fn(cb => cb())

        document.startViewTransition = mockTransition

        const { toggleDarkMode } = useLayout()

        toggleDarkMode()

        expect(mockTransition).toHaveBeenCalled()
    })

    it('adds resize event listener on mount', () => {
        const addSpy = vi.spyOn(window, 'addEventListener')

        const TestComponent = defineComponent({
            setup() {
                useLayout()
                return () => null
            },
        })

        mount(TestComponent)

        expect(addSpy).toHaveBeenCalledWith('resize', expect.any(Function))
    })
})
