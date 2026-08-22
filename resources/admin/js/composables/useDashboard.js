import { fetchAvailableCarsKpi } from '@admin/services/dashboardService'
import { ref } from 'vue'

export const useDashboard = () => {
    const availableCarsKpi = ref()

    const getAvailableCarsKpi = async () => {
        try {
            const { data } = await fetchAvailableCarsKpi()
            availableCarsKpi.value = data
        } catch (error) {
            console.error(error)
        }
    }

    return {
        availableCarsKpi,
        getAvailableCarsKpi,
    }
}
