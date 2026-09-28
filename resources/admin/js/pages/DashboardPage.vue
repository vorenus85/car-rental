<template>
    <AppLayout>
        <PageTitle title="Dashboard"> </PageTitle>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
            <DashboardKpi
                :loading="isLoading"
                :value="dashboardKpis?.availableCarsKpi"
                title="Available Cars"
                unit="cars"
                icon="car"
                :link="showAvailableCars"
            ></DashboardKpi>

            <DashboardKpi
                :loading="isLoading"
                :value="dashboardKpis?.activeRentalsKpi"
                title="Active Rentals"
                unit="rentals"
                icon="car"
                :link="showActiveRentals"
            ></DashboardKpi>

            <DashboardKpi
                :loading="isLoading"
                :value="dashboardKpis?.pendingBookingsKpi"
                title="Pending Bookings"
                unit="bookings"
                icon="clock"
                :link="showPendingRentals"
            ></DashboardKpi>

            <DashboardKpi
                :loading="isLoading"
                :value="dashboardKpis?.monthlyRevenueKpi"
                title="Monthly Revenue"
                unit="this month"
                icon="euro"
                :currency="true"
            ></DashboardKpi>

            <DashboardKpi
                :loading="isLoading"
                :value="dashboardKpis?.todayDroppOffsKpi"
                title="Today Dropoffs"
                unit="Returns scheduled today"
                icon="sign-out"
                :link="showTodayDropoffs"
            ></DashboardKpi>
            <DashboardKpi
                :loading="isLoading"
                :value="dashboardKpis?.todayPickupsKpi"
                title="Today Pick ups"
                unit="Pick ups scheduled today"
                icon="sign-in"
                :link="showTodayPickups"
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
import { onMounted, ref } from 'vue'
import { formatDate } from '@admin/utils.js'

const router = useRouter()
const isLoading = ref(true)

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

const showTodayPickups = () => {
    router.push({
        name: 'bookings',
        query: {
            pickUpDate: formatDate(new Date()),
        },
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

onMounted(async () => {
    isLoading.value = true

    await Promise.allSettled([
        getActiveRentalsKpi(),
        getAvailableCarsKpi(),
        getPendingBookingsKpi(),
        getMonthlyRevenueKpi(),
        getTodayDropoffsKpi(),
        getTodayPickupsKpi(),
    ])

    isLoading.value = false
})
</script>
