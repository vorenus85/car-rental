import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useFeature } from '@/composables/useFeature'
import { fetchFeatures, fetchFeature, deleteFeatureById } from '@/services/featureService'

const successMock = vi.fn()

vi.mock('vue-router', () => ({
    useRoute: () => ({
        params: {
            id: 123,
        },
    }),
}))

vi.mock('@/composables/useCustomToast', () => ({
    useCustomToast: () => ({
        customToast: {
            success: successMock,
        },
    }),
}))

vi.mock('@/services/featureService', () => ({
    fetchFeatures: vi.fn(),
    fetchFeature: vi.fn(),
    deleteFeatureById: vi.fn(),
}))

describe('useFeature', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const feature = useFeature()

        expect(feature.features.value).toEqual([])
        expect(feature.loading.value).toBe(false)
        expect(feature.formKey.value).toBe(0)
        expect(feature.featureId).toBe(123)

        expect(feature.initialValues).toEqual({
            name: '',
            description: '',
            category: '',
        })
    })

    it('loads features', async () => {
        vi.mocked(fetchFeatures).mockResolvedValue({
            data: {
                data: [
                    { id: 1, name: 'ABS', category: 'safety' },
                    { id: 2, name: 'Bluetooth', category: 'technology' },
                ],
            },
        })

        const feature = useFeature()

        await feature.getFeatures()

        expect(feature.features.value).toHaveLength(2)
        expect(feature.loading.value).toBe(false)
    })

    it('loads single feature', async () => {
        vi.mocked(fetchFeature).mockResolvedValue({
            data: {
                name: 'ABS',
                description: 'Anti-lock braking system',
                category: 'safety',
            },
        })

        const feature = useFeature()

        await feature.getFeature()

        expect(feature.initialValues).toEqual({
            name: 'ABS',
            description: 'Anti-lock braking system',
            category: 'safety',
        })

        expect(feature.formKey.value).toBe(1)
    })

    it('groups features by category', () => {
        const feature = useFeature()

        feature.features.value = [
            { id: 1, name: 'ABS', category: 'safety' },
            { id: 2, name: 'ESP', category: 'safety' },
            { id: 3, name: 'Bluetooth', category: 'technology' },
        ]

        const safetyGroup = feature.groupedFeatures.value.find(group => group.id === 'safety')

        const technologyGroup = feature.groupedFeatures.value.find(
            group => group.id === 'technology'
        )

        expect(safetyGroup.features).toHaveLength(2)
        expect(technologyGroup.features).toHaveLength(1)
    })

    it('deletes feature', async () => {
        vi.mocked(deleteFeatureById).mockResolvedValue({})

        const feature = useFeature()

        feature.features.value = [
            { id: 1, name: 'ABS' },
            { id: 2, name: 'ESP' },
        ]

        await feature.deleteFeature(1)

        expect(deleteFeatureById).toHaveBeenCalledWith(1)

        expect(feature.features.value).toEqual([{ id: 2, name: 'ESP' }])

        expect(successMock).toHaveBeenCalledWith('Feature deleted successfully!')
    })

    it('handles fetchFeatures error', async () => {
        vi.mocked(fetchFeatures).mockRejectedValue(new Error())

        const feature = useFeature()

        await expect(feature.getFeatures()).resolves.toBeUndefined()

        expect(feature.loading.value).toBe(false)
    })

    it('handles fetchFeature error', async () => {
        vi.mocked(fetchFeature).mockRejectedValue(new Error())

        const feature = useFeature()

        await expect(feature.getFeature()).resolves.toBeUndefined()

        expect(feature.loading.value).toBe(false)
    })

    it('handles deleteFeature error', async () => {
        vi.mocked(deleteFeatureById).mockRejectedValue(new Error())

        const feature = useFeature()

        await expect(feature.deleteFeature(1)).resolves.toBeUndefined()

        expect(feature.loading.value).toBe(false)
        expect(successMock).not.toHaveBeenCalled()
    })
})
