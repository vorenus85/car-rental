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
                    <div class="flex justify-between">
                        <Button
                            type="button"
                            icon="pi pi-filter-slash"
                            label="Clear"
                            variant="outlined"
                            @click="clearFilter()"
                        />
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
                <Column sortable field="bookingNumber" header="Booking Number" style="width: 25%">
                    <template #body="slotProps">
                        <Tag
                            class="no-wrap"
                            :value="slotProps.data.bookingNumber"
                            severity="primary"
                    /></template>
                </Column>
                <Column sortable field="customer.name" header="Customer" style="width: 15%">
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
                                class="mb-2"
                            >
                            </Button>

                            <span class="text-sm text-surface-500">
                                {{ slotProps.data.customer.email }}
                            </span>
                        </div>
                    </template>
                </Column>

                <Column sortable field="car.name" header="Car" style="width: 14%">
                    <template #body="slotProps">
                        <div class="flex flex-col">
                            <span class="font-medium no-wrap">
                                {{ slotProps.data.car.name }}
                            </span>

                            <Button
                                outlined
                                severity="info"
                                as="router-link"
                                :label="slotProps.data.car.licencePlate"
                                size="small"
                                :to="{
                                    name: 'cars.show',
                                    params: {
                                        id: slotProps.data?.car.id,
                                    },
                                }"
                                class="w-32 mt-3"
                            >
                            </Button>
                        </div>
                    </template>
                </Column>

                <Column field="pickupLocation.name" header="Pick-up Location" style="width: 13%">
                    <template #body="slotProps">
                        <span class="no-wrap font-medium">
                            {{ slotProps.data.pickupLocation.name }}
                        </span>
                        <div class="flex flex-col">
                            <div class="flex flex-col">
                                <FormatedDate :date="slotProps.data.pickupAt"></FormatedDate>
                                <FormatedTime :date="slotProps.data.pickupAt"></FormatedTime>
                            </div>
                        </div>
                    </template>
                </Column>

                <Column sortable field="status" header="Status" style="width: 10%">
                    <template #body="slotProps">
                        <BookingStatusTag :status="slotProps.data.status"></BookingStatusTag>
                    </template>
                </Column>

                <Column sortable field="paymentStatus" header="Payment Status" style="width: 10%">
                    <template #body="slotProps">
                        <PaymentStatusTag :status="slotProps.data.paymentStatus"></PaymentStatusTag>
                    </template>
                </Column>

                <Column sortable field="paymentMethod" header="Payment Method" style="width: 10%">
                    <template #body="slotProps">
                        <PaymentMethodTag :status="slotProps.data.paymentMethod"></PaymentMethodTag>
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
import { Button, Column, DataTable, IconField, InputIcon, InputText, Tag } from 'primevue'
import { onMounted, ref } from 'vue'

const { toCreateBooking } = useRedirects()
const { getBookings, bookings } = useBooking()
const filters = ref()

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
}

onMounted(() => {
    getBookings()
})
</script>
