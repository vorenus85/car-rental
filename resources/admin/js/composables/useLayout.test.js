import { afterEach, describe, it, expect, vi } from 'vitest'
import { mount } from '@vue/test-utils'
import { defineComponent } from 'vue'
import { useLayout } from './useLayout'

const TestComponent = defineComponent({
    setup() {
        return { ...useLayout() }
    },
    render() {
        return null
    },
})

describe('useLayout', () => {
    afterEach(() => {
        document.startViewTransition = undefined
    })

    it('sets isMobile based on window width', () => {
        Object.defineProperty(window, 'innerWidth', {
            writable: true,
            configurable: true,
            value: 800,
        })

        const wrapper = mount(TestComponent)

        expect(wrapper.vm.isMobile).toBe(true)
    })

    it('toggles dark mode without view transition support', () => {
        const classToggleSpy = vi.spyOn(document.documentElement.classList, 'toggle')

        const wrapper = mount(TestComponent)

        wrapper.vm.toggleDarkMode()

        expect(wrapper.vm.darkTheme).toBe(true)
        expect(classToggleSpy).toHaveBeenCalledWith('app-dark')
    })

    it('uses startViewTransition when available', () => {
        const mockTransition = vi.fn(cb => cb())

        document.startViewTransition = mockTransition

        const wrapper = mount(TestComponent)

        wrapper.vm.toggleDarkMode()

        expect(mockTransition).toHaveBeenCalled()
    })

    it('adds resize event listener on mount', () => {
        const addSpy = vi.spyOn(window, 'addEventListener')

        mount(TestComponent)

        expect(addSpy).toHaveBeenCalledWith('resize', expect.any(Function))
    })
})
