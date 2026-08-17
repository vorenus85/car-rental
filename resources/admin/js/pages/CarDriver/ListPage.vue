<template>
    <AppLayout>
        <PageTitle title="Drivers">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateCarDriver" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="carDrivers"
                paginator
                :rows="20"
                :rows-per-page-options="[20, 50]"
                table-style="min-width: 50rem"
                :loading="loading"
                :global-filter-fields="['firstName', 'lastName', 'email', 'phone']"
                data-key="id"
                ><template #header>
                    <div class="flex justify-start gap-5">
                        <Button
                            class="mr-auto"
                            width="80px"
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
                <Column sortable field="firstName" header="First Name" style="width: 20%"> </Column>
                <Column sortable field="lastName" header="Last Name" style="width: 20%"> </Column>
                <Column sortable field="phone" header="Phone" style="width: 25%"> </Column>
                <Column sortable field="updatedAt" header="Updated at" style="width: 10%">
                    <template #body="slotProps">
                        <FormatedDateTime :date="slotProps.data.updatedAt"></FormatedDateTime
                    ></template>
                </Column>
                <Column header="Actions" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button
                                severity="info"
                                icon="pi pi-eye"
                                as="router-link"
                                :to="{
                                    name: 'carDrivers.show',
                                    params: {
                                        id: slotProps.data?.id,
                                    },
                                }"
                            >
                            </Button>

                            <Button
                                icon="pi pi-trash"
                                severity="danger"
                                @click="deleteConfirm(slotProps.data.id)"
                            />
                        </div>
                    </template>
                </Column>
            </DataTable>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { useCarDriver } from '@admin/composables/useCarDriver.js'
import { Button, Column, DataTable, IconField, InputIcon, InputText, useConfirm } from 'primevue'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import { useCustomConfirm } from '@admin/composables/useCustomConfirm'
import { onMounted, ref } from 'vue'
import FormatedDateTime from '@admin/components/Table/FormatedDateTime.vue'

const { toCreateCarDriver } = useRedirects()
const filters = ref()
const confirm = useConfirm()
const { loading, carDrivers, getCarDrivers, deleteCarDriver } = useCarDriver()
const { confirmAction } = useCustomConfirm()

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        firstName: {
            operator: FilterOperator.AND,
            constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
        },
        lastName: {
            operator: FilterOperator.AND,
            constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
        },
        email: {
            operator: FilterOperator.OR,
            constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
        },
        phone: {
            operator: FilterOperator.OR,
            constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
        },
    }
}

initFilters()

const clearFilter = () => {
    initFilters()
}

const deleteConfirm = id => {
    confirmAction(confirm, {
        action: () => {
            deleteCarDriver(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(async () => {
    await getCarDrivers()
})
</script>
