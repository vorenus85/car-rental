<template>
    <AppLayout>
        <PageTitle title="Features">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateFeature" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="features"
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
                <Column sortable field="name" header="Name" style="width: 25%">
                    <template #body="slotProps">
                        <Button
                            as="router-link"
                            class="no-wrap"
                            severity="info"
                            outlined
                            :label="slotProps.data.name"
                            :to="{
                                name: 'features.show',
                                params: {
                                    id: slotProps.data?.id,
                                },
                            }"
                        >
                        </Button>
                    </template>
                </Column>
                <Column sortable field="category" header="Category" style="width: 10%"> </Column>
                <Column sortable field="description" header="Description" style="width: 25%">
                </Column>
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
                                    name: 'features.show',
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
import { Button, Column, DataTable, IconField, InputIcon, InputText, useConfirm } from 'primevue'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { useFeature } from '@admin/composables/useFeature'
import { useCustomConfirm } from '@admin/composables/useCustomConfirm'
import { onMounted, ref } from 'vue'
import FormatedDateTime from '@admin/components/Table/FormatedDateTime.vue'

const { toCreateFeature } = useRedirects()
const confirm = useConfirm()
const { loading, features, getFeatures, deleteFeature } = useFeature()
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
            deleteFeature(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(() => {
    getFeatures()
})
</script>
