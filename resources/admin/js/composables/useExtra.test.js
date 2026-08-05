import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useExtra } from '@admin/composables/useExtra'
import { fetchExtras, fetchExtra, deleteExtraById } from '@admin/services/extraService'

const successMock = vi.fn()

vi.mock('vue-router', () => ({
    useRoute: () => ({
        params: {
            id: 123,
        },
    }),
}))

vi.mock('@admin/composables/useCustomToast', () => ({
    useCustomToast: () => ({
        customToast: {
            success: successMock,
        },
    }),
}))

vi.mock('@admin/services/extraService', () => ({
    fetchExtras: vi.fn(),
    fetchExtra: vi.fn(),
    deleteExtraById: vi.fn(),
}))

describe('useExtra', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const extra = useExtra()

        expect(extra.extraId).toBe(123)
        expect(extra.loading.value).toBe(false)
        expect(extra.formKey.value).toBe(0)
        expect(extra.extras.value).toEqual([])
        expect(extra.initialValues).toEqual({
            name: '',
            description: '',
            price: '',
            icon: '',
            maxQuantity: '',
        })
    })

    it('loads extras', async () => {
        const extrasData = [
            { id: 1, name: 'GPS', price: 10 },
            { id: 2, name: 'Child seat', price: 15 },
        ]

        vi.mocked(fetchExtras).mockResolvedValue({
            data: extrasData,
        })

        const extra = useExtra()

        await extra.getExtras()

        expect(fetchExtras).toHaveBeenCalledTimes(1)
        expect(extra.extras.value).toEqual(extrasData)
        expect(extra.loading.value).toBe(false)
    })

    it('loads extra details', async () => {
        vi.mocked(fetchExtra).mockResolvedValue({
            data: {
                name: 'GPS',
                description: 'Navigation system',
                price: 10,
                icon: 'pi pi-map',
                maxQuantity: 2,
            },
        })

        const extra = useExtra()

        await extra.getExtra()

        expect(fetchExtra).toHaveBeenCalledWith(123)
        expect(extra.initialValues).toEqual({
            name: 'GPS',
            description: 'Navigation system',
            price: 10,
            icon: 'pi pi-map',
            maxQuantity: 2,
        })
        expect(extra.formKey.value).toBe(1)
        expect(extra.loading.value).toBe(false)
    })

    it('deletes extra', async () => {
        vi.mocked(deleteExtraById).mockResolvedValue({})

        const extra = useExtra()

        extra.extras.value = [
            { id: 1, name: 'GPS' },
            { id: 2, name: 'Child seat' },
        ]

        await extra.deleteExtra(1)

        expect(deleteExtraById).toHaveBeenCalledWith(1)
        expect(extra.extras.value).toEqual([{ id: 2, name: 'Child seat' }])
        expect(successMock).toHaveBeenCalledWith('Extra deleted successfully!')
    })

    it('handles getExtras errors', async () => {
        vi.mocked(fetchExtras).mockRejectedValue(new Error('API Error'))

        const extra = useExtra()

        await expect(extra.getExtras()).resolves.toBeUndefined()

        expect(extra.loading.value).toBe(false)
    })

    it('handles getExtra errors', async () => {
        vi.mocked(fetchExtra).mockRejectedValue(new Error('API Error'))

        const extra = useExtra()

        await expect(extra.getExtra()).resolves.toBeUndefined()

        expect(extra.loading.value).toBe(false)
    })

    it('handles deleteExtra errors', async () => {
        vi.mocked(deleteExtraById).mockRejectedValue(new Error('API Error'))

        const extra = useExtra()

        await expect(extra.deleteExtra(1)).resolves.toBeUndefined()

        expect(extra.loading.value).toBe(false)
        expect(successMock).not.toHaveBeenCalled()
    })
})
