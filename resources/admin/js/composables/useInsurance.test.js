import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useInsurance } from '@admin/composables/useInsurance'
import {
    fetchInsurances,
    fetchInsurance,
    deleteInsuranceById,
} from '@admin/services/insuranceService'

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

vi.mock('@admin/services/insuranceService', () => ({
    fetchInsurances: vi.fn(),
    fetchInsurance: vi.fn(),
    deleteInsuranceById: vi.fn(),
}))

describe('useInsurance', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const insurance = useInsurance()

        expect(insurance.insuranceId).toBe(123)
        expect(insurance.loading.value).toBe(false)
        expect(insurance.formKey.value).toBe(0)
        expect(insurance.insurances.value).toEqual([])

        expect(insurance.initialValues).toEqual({
            name: '',
            description: '',
            price: '',
            recommended: false,
        })
    })

    it('loads insurances', async () => {
        const insurancesData = [
            { id: 1, name: 'Basic', price: 10 },
            { id: 2, name: 'Full', price: 25 },
        ]

        vi.mocked(fetchInsurances).mockResolvedValue({
            data: insurancesData,
        })

        const insurance = useInsurance()

        await insurance.getInsurances()

        expect(fetchInsurances).toHaveBeenCalledTimes(1)
        expect(insurance.insurances.value).toEqual(insurancesData)
        expect(insurance.loading.value).toBe(false)
    })

    it('loads single insurance', async () => {
        vi.mocked(fetchInsurance).mockResolvedValue({
            data: {
                name: 'Basic',
                description: 'Basic coverage',
                price: 10,
                recommended: 1,
            },
        })

        const insurance = useInsurance()

        await insurance.getInsurance()

        expect(fetchInsurance).toHaveBeenCalledWith(123)
        expect(insurance.initialValues).toEqual({
            name: 'Basic',
            description: 'Basic coverage',
            price: 10,
            recommended: true,
        })
        expect(insurance.formKey.value).toBe(1)
        expect(insurance.loading.value).toBe(false)
    })

    it('deletes insurance', async () => {
        vi.mocked(deleteInsuranceById).mockResolvedValue({})

        const insurance = useInsurance()

        insurance.insurances.value = [
            { id: 1, name: 'Basic' },
            { id: 2, name: 'Full' },
        ]

        await insurance.deleteInsurance(1)

        expect(deleteInsuranceById).toHaveBeenCalledWith(1)
        expect(insurance.insurances.value).toEqual([{ id: 2, name: 'Full' }])
        expect(successMock).toHaveBeenCalledWith('Insurance deleted successfully!')
    })

    it('handles getInsurances errors', async () => {
        vi.mocked(fetchInsurances).mockRejectedValue(new Error('API Error'))

        const insurance = useInsurance()

        await expect(insurance.getInsurances()).resolves.toBeUndefined()

        expect(insurance.loading.value).toBe(false)
    })

    it('handles getInsurance errors', async () => {
        vi.mocked(fetchInsurance).mockRejectedValue(new Error('API Error'))

        const insurance = useInsurance()

        await expect(insurance.getInsurance()).resolves.toBeUndefined()

        expect(insurance.loading.value).toBe(false)
    })

    it('handles deleteInsurance errors', async () => {
        vi.mocked(deleteInsuranceById).mockRejectedValue(new Error('API Error'))

        const insurance = useInsurance()

        await expect(insurance.deleteInsurance(1)).resolves.toBeUndefined()

        expect(insurance.loading.value).toBe(false)
        expect(successMock).not.toHaveBeenCalled()
    })
})
