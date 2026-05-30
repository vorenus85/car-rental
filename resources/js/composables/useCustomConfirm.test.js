import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useCustomConfirm } from '@/composables/useCustomConfirm'

describe('useCustomConfirm', () => {
    let confirmMock

    beforeEach(() => {
        confirmMock = {
            require: vi.fn(),
        }
    })

    it('uses default values', () => {
        const { confirmAction } = useCustomConfirm()

        const action = vi.fn()

        confirmAction(confirmMock, { action })

        expect(confirmMock.require).toHaveBeenCalledWith(
            expect.objectContaining({
                message: 'Do you want to delete this record?',
                header: 'Danger Zone',
                icon: 'pi pi-info-circle',
            })
        )
    })

    it('uses custom values', () => {
        const { confirmAction } = useCustomConfirm()

        const action = vi.fn()

        confirmAction(confirmMock, {
            action,
            message: 'Custom message',
            header: 'Custom header',
            icon: 'pi pi-trash',
            acceptLabel: 'Delete',
            rejectLabel: 'Close',
        })

        expect(confirmMock.require).toHaveBeenCalledWith(
            expect.objectContaining({
                message: 'Custom message',
                header: 'Custom header',
                icon: 'pi pi-trash',
                rejectLabel: 'Close',
                rejectProps: {
                    label: 'Close',
                    severity: 'secondary',
                    outlined: true,
                },
                acceptProps: {
                    label: 'Delete',
                    severity: 'danger',
                },
            })
        )
    })

    it('calls action when accepted', () => {
        const { confirmAction } = useCustomConfirm()

        const action = vi.fn()

        confirmAction(confirmMock, { action })

        const config = confirmMock.require.mock.calls[0][0]

        config.accept()

        expect(action).toHaveBeenCalledTimes(1)
    })

    it('does not call action when rejected', () => {
        const { confirmAction } = useCustomConfirm()

        const action = vi.fn()

        confirmAction(confirmMock, { action })

        const config = confirmMock.require.mock.calls[0][0]

        config.reject()

        expect(action).not.toHaveBeenCalled()
    })
})
