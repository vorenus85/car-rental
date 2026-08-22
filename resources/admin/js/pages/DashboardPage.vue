<template>
    <AppLayout>
        <PageTitle title="Dashboard"> </PageTitle>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <DashboardKpi
                :value="availableCarsKpi"
                title="Available Cars"
                unit="cars"
                icon="car"
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

const { availableCarsKpi, getAvailableCarsKpi } = useDashboard()

onMounted(() => {
    getAvailableCarsKpi()
})
</script>
