import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useCustomToast } from '@admin/composables/useCustomToast'

const addMock = vi.fn()

vi.mock('primevue/usetoast', () => ({
    useToast: () => ({
        add: addMock,
    }),
}))

describe('useCustomToast', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('shows error toast', () => {
        const { customToast } = useCustomToast()

        customToast.error('Something went wrong')

        expect(addMock).toHaveBeenCalledWith({
            severity: 'error',
            summary: 'Something went wrong',
            life: 3000,
        })
    })

    it('shows success toast', () => {
        const { customToast } = useCustomToast()

        customToast.success('Saved successfully')

        expect(addMock).toHaveBeenCalledWith({
            severity: 'success',
            summary: 'Saved successfully',
            life: 3000,
        })
    })

    it('calls toast.add once', () => {
        const { customToast } = useCustomToast()

        customToast.success('Saved successfully')

        expect(addMock).toHaveBeenCalledTimes(1)
    })
})
