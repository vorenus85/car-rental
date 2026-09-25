<template>
    <AppLayout>
        <PageTitle title="Variants">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateVariant" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="variants"
                paginator
                :rows="20"
                :rows-per-page-options="[20, 50]"
                table-style="min-width: 50rem"
                :loading="loading"
                :global-filter-fields="['name', 'description']"
                data-key="id"
            >
                <template #header>
                    <div class="flex justify-between gap-2">
                        <Button
                            v-tooltip="'Clear filter'"
                            type="button"
                            icon="pi pi-filter-slash"
                            variant="outlined"
                            severity="info"
                            @click="clearFilter()"
                        />
                        <IconField class="w-40">
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Search" />
                        </IconField>
                    </div>
                </template>
                <template #empty> No results found. </template>
                <Column sortable field="name" header="Name" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex gap-1">
                            <Button
                                as="router-link"
                                class="no-wrap"
                                severity="info"
                                outlined
                                :label="slotProps.data.name"
                                :to="{
                                    name: 'variants.show',
                                    params: {
                                        id: slotProps.data?.id,
                                    },
                                }"
                            >
                            </Button>
                        </div>
                    </template>
                </Column>
                <Column sortable field="model.brand.name" header="Brand / Model" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex gap-1">
                            <Tag
                                :value="slotProps.data.model.brand.name"
                                severity="secondary"
                                class="no-wrap"
                            />
                            <Tag
                                :value="slotProps.data.model.name"
                                severity="secondary"
                                class="no-wrap"
                            />
                        </div> </template
                ></Column>
                <Column sortable field="body_type" header="Body type" style="width: 10%"> </Column
                ><Column sortable field="fuel" header="Fuel" style="width: 10%"> </Column>
                <Column sortable field="transmission" header="Transmission" style="width: 10%">
                </Column>
                <Column sortable field="seats" header="Seats" style="width: 10%"> </Column>
                <Column sortable field="luggage_count" header="Luggages" style="width: 10%">
                </Column>
                <Column sortable field="range_km" header="Range" style="width: 10%">
                    <template #body="slotProps">
                        <div>{{ slotProps.data.range_km }} km</div>
                    </template></Column
                >
                <Column sortable field="updated_at" header="Updated at" style="width: 10%">
                    <template #body="slotProps">
                        <FormatedDateTime :date="slotProps.data.updated_at"></FormatedDateTime
                    ></template>
                </Column>
                <Column header="Actions" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button
                                icon="pi pi-eye"
                                severity="info"
                                as="router-link"
                                :to="{
                                    name: 'variants.show',
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
                    </template> </Column
            ></DataTable>
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
    Tag,
    useConfirm,
} from 'primevue'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { onMounted, ref } from 'vue'
import { useVariant } from '@admin/composables/useVariant.js'
import { useCustomConfirm } from '@admin/composables/useCustomConfirm'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import FormatedDateTime from '@admin/components/Table/FormatedDateTime.vue'

const { toCreateVariant } = useRedirects()
const { loading, variants, getVariants, deleteVariant } = useVariant()
const confirm = useConfirm()
const { confirmAction } = useCustomConfirm()

const filters = ref()

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
            deleteVariant(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(async () => {
    await getVariants()
})
</script>
