<template>
    <AppLayout>
        <PageTitle title="Locations">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateLocation" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="locations"
                paginator
                :rows="20"
                :rows-per-page-options="[20, 50]"
                table-style="min-width: 50rem"
                :loading="loading"
                :global-filter-fields="['name', 'description']"
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
                <Column sortable field="name" header="Name" style="width: 10%">
                    <template #body="slotProps">
                        <Tag :value="slotProps.data.name" severity="secondary" class="no-wrap"
                    /></template>
                </Column>
                <Column sortable field="phone" header="Phone" style="width: 5%">
                    <template #body="slotProps">
                        <span class="no-wrap">{{ slotProps.data.phone }}</span>
                    </template>
                </Column>

                <Column sortable field="country" header="Country" style="width: 5%">
                    <template #body="slotProps">
                        <div class="flex items-center gap-2">
                            <img
                                :alt="countriesMap[slotProps.data.country]"
                                src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png"
                                :class="`mr-2 flag flag-${slotProps.data.country.toLowerCase()}`"
                                style="width: 18px"
                            />
                            {{ countriesMap[slotProps.data.country] }}
                        </div>
                    </template>
                </Column>
                <Column sortable field="city" header="City" style="width: 5%">
                    <template #body="slotProps">
                        {{ slotProps.data.city }}
                    </template>
                </Column>
                <Column sortable field="type" header="Type" style="width: 5%">
                    <template #body="slotProps">
                        {{ locationTypeMap[slotProps.data.type] }}
                    </template>
                </Column>
                <Column sortable field="total_cars_count" header="Total" style="width: 5%">
                    <template #body="slotProps">
                        {{ slotProps.data.total_cars_count }}
                    </template>
                </Column>
                <Column sortable field="available_cars_count" header="Available " style="width: 5%">
                    <template #body="slotProps">
                        {{ slotProps.data.available_cars_count }}
                    </template>
                </Column>
                <Column sortable field="rented_cars_count" header="Rented" style="width: 5%">
                    <template #body="slotProps">
                        {{ slotProps.data.rented_cars_count }}
                    </template>
                </Column>
                <Column sortable field="maintenance_cars_count" header="Service " style="width: 5%">
                    <template #body="slotProps">
                        {{ slotProps.data.maintenance_cars_count }}
                    </template>
                </Column>
                <Column sortable field="updated_at" header="Updated at" style="width: 5%">
                    <template #body="slotProps">
                        <FormatedDate :date="slotProps.data.updated_at"></FormatedDate
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
                                    name: 'locations.show',
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
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import {
    Button,
    Column,
    DataTable,
    IconField,
    InputIcon,
    InputText,
    Tag,
    useConfirm,
} from 'primevue'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import { useRedirects } from '@/composables/useRedirects.js'
import { useLocation } from '@/composables/useLocation'
import { useCustomConfirm } from '@/composables/useCustomConfirm'
import { onMounted, ref } from 'vue'
import FormatedDate from '@/components/Table/FormatedDate.vue'

const { toCreateLocation } = useRedirects()
const confirm = useConfirm()
const { loading, locations, getLocations, deleteLocation, countriesMap, locationTypeMap } =
    useLocation()
const filters = ref()
const { confirmAction } = useCustomConfirm()

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: {
            operator: FilterOperator.AND,
            constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
        },
        description: {
            operator: FilterOperator.AND,
            constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
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
            deleteLocation(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(async () => {
    await getLocations()
})
</script>
