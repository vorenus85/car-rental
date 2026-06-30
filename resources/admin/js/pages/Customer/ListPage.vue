<template>
    <AppLayout>
        <PageTitle title="Clients">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateCustomer" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="customers"
                paginator
                :rows="20"
                :rows-per-page-options="[20, 50]"
                table-style="min-width: 50rem"
                :loading="loading"
                :global-filter-fields="['name', 'email', 'phone']"
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
                <Column sortable field="name" header="Name" style="width: 20%"> </Column>
                <Column sortable field="email" header="Email" style="width: 25%"> </Column>
                <Column sortable field="phone" header="Phone" style="width: 25%"> </Column>
                <Column sortable field="active" header="Active" style="width: 5%">
                    <template #body="slotProps">
                        <ToggleSwitch
                            :model-value="Boolean(slotProps.data.active)"
                            @change="toggleActive(slotProps.data.id)"
                        />
                    </template>
                </Column>
                <Column header="Actions" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button
                                v-tooltip="'Send reset password'"
                                icon="pi pi-refresh"
                                severity="info"
                                @click="doSendPasswordReset(slotProps.data.id)"
                            />
                            <Button
                                severity="info"
                                icon="pi pi-eye"
                                as="router-link"
                                :to="{
                                    name: 'clients.show',
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
import {
    Button,
    Column,
    DataTable,
    IconField,
    InputIcon,
    InputText,
    ToggleSwitch,
    useConfirm,
} from 'primevue'
import { useCustomConfirm } from '@admin/composables/useCustomConfirm'
import { useCustomer } from '@admin/composables/useCustomer.js'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import { onMounted, ref } from 'vue'

const filters = ref()
const confirm = useConfirm()
const { confirmAction } = useCustomConfirm()
const { loading, customers, getCustomers, deleteCustomer, toggleActive, doSendPasswordReset } =
    useCustomer()
const { toCreateCustomer } = useRedirects()

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: {
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
            deleteCustomer(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(async () => {
    await getCustomers()
})
</script>
