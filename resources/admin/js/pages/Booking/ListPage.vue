<template>
    <AppLayout>
        <PageTitle title="Bookings">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateBooking" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="bookings"
                paginator
                :rows="20"
                :rows-per-page-options="[20, 50]"
                table-style="min-width: 50rem"
                :loading="loading"
                :global-filter-fields="['bookingNumber', 'customer.name']"
                data-key="id"
            >
                <template #header>
                    <div class="flex justify-between gap-3">
                        <Button
                            type="button"
                            icon="pi pi-filter-slash"
                            label="Clear"
                            variant="outlined"
                            @click="clearFilter()"
                        />
                        <FloatLabel variant="on" class="ml-auto">
                            <DatePicker
                                v-model="dropOffDate"
                                input-id="on_label"
                                show-icon
                                icon-display="input"
                                date-format="yy. mm. dd."
                            />
                            <label for="on_label">Drop-off Date</label>
                        </FloatLabel>
                        <IconField>
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText
                                v-model="filters['global'].value"
                                placeholder="Keyword Search"
                            />
                        </IconField>
                    </div>
                </template>
                <template #empty> No results found. </template>
                <Column sortable field="id" header="#Id" style="width: 2%">
                    <template #body="slotProps">
                        <strong>{{ slotProps.data.id }}</strong>
                    </template>
                </Column>
                <Column sortable field="bookingNumber" header="Booking Number" style="width: 25%">
                    <template #body="slotProps">
                        <Button
                            as="router-link"
                            :to="{
                                name: 'bookings.show',
                                params: {
                                    id: slotProps.data?.id,
                                },
                            }"
                            class="no-wrap"
                            :label="slotProps.data.bookingNumber"
                            severity="primary"
                    /></template>
                </Column>
                <Column sortable field="customer.name" header="Customer" style="width: 10%">
                    <template #body="slotProps">
                        <div class="">
                            <Button
                                severity="info"
                                outlined
                                as="router-link"
                                :label="slotProps.data.customer.name"
                                size="small"
                                :to="{
                                    name: 'customers.show',
                                    params: {
                                        id: slotProps.data?.customer.id,
                                    },
                                }"
                                class="no-wrap"
                            >
                            </Button>
                        </div>
                    </template>
                </Column>

                <Column sortable field="status" header="Status" style="width: 10%">
                    <template #body="slotProps">
                        <BookingStatusTag :status="slotProps.data.status"></BookingStatusTag>
                    </template>
                </Column>

                <Column sortable field="pickupAt" header="Pick-up" style="width: 13%">
                    <template #body="slotProps">
                        <span class="no-wrap font-small">
                            {{ slotProps.data.pickupLocation.name }}
                        </span>
                        <div class="flex flex-col">
                            <FormatedDate :date="slotProps.data.pickupAt"></FormatedDate>
                            <FormatedTime :date="slotProps.data.pickupAt"></FormatedTime>
                        </div>
                    </template>
                </Column>

                <Column sortable field="dropoffAt" header="Drop-off" style="width: 13%">
                    <template #body="slotProps">
                        <span class="no-wrap font-small">
                            {{ slotProps.data.dropoffLocation.name }}
                        </span>
                        <div class="flex flex-col">
                            <FormatedDate :date="slotProps.data.dropoffAt"></FormatedDate>

                            <FormatedTime :date="slotProps.data.dropoffAt"></FormatedTime>
                        </div>
                    </template>
                </Column>

                <Column sortable field="paymentStatus" header="Payment" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex gap-2 align-center">
                            <PaymentMethodTag
                                :status="slotProps.data.paymentMethod"
                            ></PaymentMethodTag>
                            <span class="dot"></span>
                            <PaymentStatusTag
                                :status="slotProps.data.paymentStatus"
                            ></PaymentStatusTag>
                        </div>
                    </template>
                </Column>

                <Column sortable field="totalAmount" header="Total" style="width: 10%">
                    <template #body="slotProps">
                        <PriceTag class="no-wrap" :price="slotProps.data.totalAmount"></PriceTag>
                    </template>
                </Column>

                <Column header="Actions" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button
                                severity="info"
                                icon="pi pi-eye"
                                as="router-link"
                                :to="{
                                    name: 'bookings.show',
                                    params: {
                                        id: slotProps.data?.id,
                                    },
                                }"
                            >
                            </Button>
                        </div>
                    </template> </Column
            ></DataTable>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import { useRedirects } from '@admin/composables/useRedirects.js'
import FormatedDate from '@admin/components/Table/FormatedDate.vue'
import FormatedTime from '@admin/components/Table/FormatedTime.vue'
import PriceTag from '@admin/components/Table/PriceTag.vue'
import BookingStatusTag from '@admin/components/Table/BookingStatusTag.vue'
import PaymentStatusTag from '@admin/components/Table/PaymentStatusTag.vue'
import PaymentMethodTag from '@admin/components/Table/PaymentMethodTag.vue'
import { useBooking } from '@admin/composables/useBooking'
import { useRoute, useRouter } from 'vue-router'
import {
    Button,
    Column,
    DataTable,
    DatePicker,
    FloatLabel,
    IconField,
    InputIcon,
    InputText,
} from 'primevue'
import { onMounted, ref, watch } from 'vue'
import { formatDate } from '@admin/utils.js'

const route = useRoute()
const router = useRouter()
const { toCreateBooking } = useRedirects()
const { getBookings, bookings, loading } = useBooking()
const filters = ref()
const dropOffDate = ref(null)

const syncParamsFromQuery = () => {
    const dropOffDateParam = route.query.dropOffDate
    if (dropOffDateParam) {
        const queryDropOffDate = new Date(dropOffDateParam)
        queryDropOffDate.setHours(0, 0, 0, 0)
        dropOffDate.value = queryDropOffDate
    } else {
        dropOffDate.value = null
    }
}

const updateDropOffDateQuery = date => {
    const query = { ...route.query }

    if (date) {
        query.dropOffDate = formatDate(date)
    } else {
        delete query.dropOffDate
    }

    router.push({ query })
}

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        bookingNumber: {
            operator: FilterOperator.AND,
            constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
        },
        'customer.name': {
            operator: FilterOperator.AND,
            constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
        },
    }
}

initFilters()

const clearFilter = () => {
    initFilters()
    dropOffDate.value = null
}

onMounted(async () => {
    syncParamsFromQuery()
    await getBookings()
})

watch(
    () => route.query,
    async () => {
        syncParamsFromQuery()
        await getBookings(route.query)
    },
    { deep: true }
)

watch(dropOffDate, date => {
    const queryDropOffDate = route.query.dropOffDate ?? null
    const selectedDropOffDate = date ? formatDate(date) : null

    if (queryDropOffDate === selectedDropOffDate) {
        return
    }

    updateDropOffDateQuery(date)
})
</script>
<style>
.dot {
    display: inline-block;
    width: 5px;
    height: 5px;
    background-color: #ccc;
    border-radius: 100%;
    margin: auto 5px;
}
</style>
