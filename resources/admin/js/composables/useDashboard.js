import { fetchAvailableCarsKpi, fetchTodayDropoffsKpi } from '@admin/services/dashboardService'
import { reactive } from 'vue'

export const useDashboard = () => {
    const dashboardKpis = reactive({
        availableCarsKpi: 0,
        todayDroppOffsKpi: 0,
    })

    const getAvailableCarsKpi = async () => {
        try {
            const { data } = await fetchAvailableCarsKpi()
            dashboardKpis.availableCarsKpi = data
        } catch (error) {
            console.error(error)
        }
    }

    const getTodayDropoffsKpi = async () => {
        try {
            const { data } = await fetchTodayDropoffsKpi()
            dashboardKpis.todayDroppOffsKpi = data
        } catch (error) {
            console.error(error)
        }
    }

    return {
        dashboardKpis,
        getAvailableCarsKpi,
        getTodayDropoffsKpi,
    }
}
