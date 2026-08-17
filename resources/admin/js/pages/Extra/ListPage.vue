<template>
    <AppLayout>
        <PageTitle title="Extras">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateExtra" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="extras"
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
                <Column sortable field="name" header="Name" style="width: 25%">
                    <template #body="slotProps">
                        <Tag :value="slotProps.data.name" severity="secondary"
                    /></template>
                </Column>
                <Column sortable field="price" header="Price / Day" style="width: 10%">
                    <template #body="slotProps">
                        <PriceTag :price="slotProps.data.price"></PriceTag>
                    </template>
                </Column>
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
                                    name: 'extras.show',
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
import FormatedDateTime from '@admin/components/Table/FormatedDateTime.vue'
import { useCustomConfirm } from '@admin/composables/useCustomConfirm'
import { useExtra } from '@admin/composables/useExtra'
import { onMounted, ref } from 'vue'
import PriceTag from '../../components/Table/PriceTag.vue'

const { getExtras, extras, loading, deleteExtra } = useExtra()
const { toCreateExtra } = useRedirects()
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
            deleteExtra(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(() => {
    getExtras()
})
</script>
