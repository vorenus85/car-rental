import {
    fetchAvailableCarsKpi,
    fetchMonthlyRevenueKpi,
    fetchTodayDropoffsKpi,
    fetchTodayPickupsKpi,
} from '@admin/services/dashboardService'
import { reactive } from 'vue'

export const useDashboard = () => {
    const dashboardKpis = reactive({
        availableCarsKpi: 0,
        monthlyRevenueKpi: 0,
        todayDroppOffsKpi: 0,
        todayPickupsKpi: 0,
    })

    const getAvailableCarsKpi = async () => {
        try {
            const { data } = await fetchAvailableCarsKpi()
            dashboardKpis.availableCarsKpi = data
        } catch (error) {
            console.error(error)
        }
    }

    const getMonthlyRevenueKpi = async () => {
        try {
            const { data } = await fetchMonthlyRevenueKpi()
            dashboardKpis.monthlyRevenueKpi = data
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

    const getTodayPickupsKpi = async () => {
        try {
            const { data } = await fetchTodayPickupsKpi()
            dashboardKpis.todayPickupsKpi = data
        } catch (error) {
            console.error(error)
        }
    }

    return {
        dashboardKpis,
        getAvailableCarsKpi,
        getMonthlyRevenueKpi,
        getTodayDropoffsKpi,
        getTodayPickupsKpi,
    }
}
