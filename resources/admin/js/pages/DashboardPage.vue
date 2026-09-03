<template>
    <AppLayout>
        <PageTitle title="Dashboard"> </PageTitle>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <DashboardKpi
                :value="dashboardKpis?.availableCarsKpi"
                title="Available Cars"
                unit="cars"
                icon="car"
            ></DashboardKpi>

            <DashboardKpi
                :value="dashboardKpis?.activeRentalsKpi"
                title="Active Rentals"
                unit="rentals"
                icon="car"
            ></DashboardKpi>

            <DashboardKpi
                :value="dashboardKpis?.pendingBookingsKpi"
                title="Pending Bookings"
                unit="bookings"
                icon="clock"
            ></DashboardKpi>

            <DashboardKpi
                :value="dashboardKpis?.monthlyRevenueKpi"
                title="Monthly Revenue"
                unit="€ this month"
                icon="euro"
            ></DashboardKpi>

            <DashboardKpi
                :value="dashboardKpis?.todayDroppOffsKpi"
                title="Today Dropoffs"
                unit="Returns scheduled today"
                icon="sign-out"
            ></DashboardKpi>
            <DashboardKpi
                :value="dashboardKpis?.todayPickupsKpi"
                title="Today Pick ups"
                unit="Pick ups scheduled today"
                icon="sign-in"
            ></DashboardKpi>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import DashboardKpi from '@admin/components/DashboardKpi.vue'
import { useDashboard } from '@admin/composables/useDashboard'
import { onMounted } from 'vue'

const {
    dashboardKpis,
    getActiveRentalsKpi,
    getAvailableCarsKpi,
    getPendingBookingsKpi,
    getMonthlyRevenueKpi,
    getTodayDropoffsKpi,
    getTodayPickupsKpi,
} = useDashboard()

onMounted(() => {
    Promise.allSettled([
        getActiveRentalsKpi(),
        getAvailableCarsKpi(),
        getPendingBookingsKpi(),
        getMonthlyRevenueKpi(),
        getTodayDropoffsKpi(),
        getTodayPickupsKpi(),
    ])
})
</script>
