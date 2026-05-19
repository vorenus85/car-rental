import axios from 'axios'
import {
    fetchFeatures,
    fetchFeature,
    deleteFeatureById,
    createFeature,
    updateFeatureById,
} from '@/services/featureService'

vi.mock('axios')

describe('featureService', () => {
    afterEach(() => {
        vi.clearAllMocks()
    })

    it('fetchFeatures calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        await fetchFeatures()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/features')
    })

    it('fetchFeature calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: {},
        })

        await fetchFeature(1)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/features/1')
    })

    it('deleteFeatureById calls correct endpoint', async () => {
        axios.delete.mockResolvedValue({
            data: {},
        })

        await deleteFeatureById(1)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/features/1')
    })

    it('createFeature sends payload correctly', async () => {
        const values = {
            name: 'ABS',
            category: 'safety',
            description: 'Anti-lock braking system',
        }

        axios.post.mockResolvedValue({
            data: values,
        })

        await createFeature(values)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/features', values)
    })

    it('updateFeatureById sends payload correctly', async () => {
        const values = {
            name: 'ESP',
            category: 'safety',
            description: 'Electronic stability program',
        }

        axios.put.mockResolvedValue({
            data: values,
        })

        await updateFeatureById(1, values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/features/1', values)
    })
})
