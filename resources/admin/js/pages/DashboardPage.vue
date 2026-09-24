<template>
    <AppLayout>
        <PageTitle title="Dashboard"> </PageTitle>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <DashboardKpi
                :value="dashboardKpis?.availableCarsKpi"
                title="Available Cars"
                unit="cars"
                icon="car"
                :link="showAvailableCars"
            ></DashboardKpi>

            <DashboardKpi
                :value="dashboardKpis?.activeRentalsKpi"
                title="Active Rentals"
                unit="rentals"
                icon="car"
                :link="showActiveRentals"
            ></DashboardKpi>

            <DashboardKpi
                :value="dashboardKpis?.pendingBookingsKpi"
                title="Pending Bookings"
                unit="bookings"
                icon="clock"
                :link="showPendingRentals"
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
                :link="showTodayDropoffs"
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
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'
import { formatDate } from '@admin/utils.js'

const router = useRouter()

const {
    dashboardKpis,
    getActiveRentalsKpi,
    getAvailableCarsKpi,
    getPendingBookingsKpi,
    getMonthlyRevenueKpi,
    getTodayDropoffsKpi,
    getTodayPickupsKpi,
} = useDashboard()

const showAvailableCars = () => {
    router.push({
        name: 'cars',
        query: {
            status: 'available',
        },
    })
}

const showActiveRentals = () => {
    router.push({
        name: 'activeRentals',
    })
}

const showPendingRentals = () => {
    router.push({
        name: 'pendingRentals',
    })
}

const showTodayDropoffs = () => {
    router.push({
        name: 'bookings',
        query: {
            dropOffDate: formatDate(new Date()),
        },
    })
}

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
