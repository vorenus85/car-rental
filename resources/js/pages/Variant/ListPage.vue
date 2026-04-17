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
                            <Tag
                                :value="slotProps.data.name"
                                severity="secondary"
                                class="no-wrap"
                            />
                        </div>
                    </template>
                </Column>
                <Column sortable field="category" header="Category" style="width: 10%"> </Column
                ><Column sortable field="fuel" header="Fuel" style="width: 10%"> </Column>
                <Column sortable field="transmission" header="Transmission" style="width: 10%">
                </Column>
                <Column sortable field="seats" header="Seats" style="width: 10%"> </Column>
                <Column header="Actions" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button v-slot="buttonProps" severity="info" as-child>
                                <RouterLink
                                    :to="{
                                        name: 'variants.show',
                                        params: {
                                            id: slotProps.data?.id,
                                        },
                                    }"
                                    :class="buttonProps.class"
                                    >Edit</RouterLink
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
import { useRedirects } from '@/composables/useRedirects.js'
import { onMounted, ref } from 'vue'
import { useVariant } from '@/composables/useVariant.js'
import { useCustomConfirm } from '@/composables/useCustomConfirm'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'

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
