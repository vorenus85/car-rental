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
                    <template #body="slotProps"> <Chip :label="slotProps.data.name" /></template>
                </Column>
                <Column sortable field="category" header="Category" style="width: 10%"> </Column
            ></DataTable>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import { Button, Chip, Column, DataTable, IconField, InputIcon, InputText } from 'primevue'
import { useRedirects } from '@/composables/useRedirects.js'
import { onMounted, ref } from 'vue'
import { useVariant } from '@/composables/useVariant.js'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'

const { toCreateVariant } = useRedirects()
const { loading, variants, getVariants } = useVariant()
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

onMounted(async () => {
    await getVariants()
    console.log(variants)
})
</script>
