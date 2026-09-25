<template>
    <AppLayout>
        <PageTitle title="Models">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateModel" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="carModels"
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
                <Column sortable field="name" header="Name" style="width: 5%">
                    <template #body="slotProps">
                        <Button
                            as="router-link"
                            class="no-wrap"
                            severity="info"
                            outlined
                            :label="slotProps.data.name"
                            :to="{
                                name: 'models.show',
                                params: {
                                    id: slotProps.data?.id,
                                },
                            }"
                        >
                        </Button>
                    </template>
                </Column>
                <Column sortable field="brand.name" header="Brand" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex gap-1 items-center">
                            <Image
                                :src="
                                    slotProps.data?.brand.image
                                        ? `${slotProps.data.brand.imageUrl}`
                                        : '/no-image.jpg'
                                "
                                :alt="slotProps.data?.title"
                            />
                            <Tag :value="slotProps.data.brand.name" severity="secondary" />
                        </div>
                    </template>
                </Column>

                <Column sortable field="description" header="Description" style="width: 30%">
                </Column>
                <Column sortable field="updatedAt" header="Updated at" style="width: 10%">
                    <template #body="slotProps">
                        <FormatedDateTime :date="slotProps.data.updatedAt"></FormatedDateTime
                    ></template>
                </Column>
                <Column header="Actions" style="width: 20%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button
                                severity="info"
                                as="router-link"
                                icon="pi pi-eye"
                                :to="{
                                    name: 'models.show',
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
    Image,
    InputIcon,
    InputText,
    Tag,
    useConfirm,
} from 'primevue'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { useCarModel } from '@admin/composables/useCarModel'
import { useCustomConfirm } from '@admin/composables/useCustomConfirm'
import { onMounted, ref } from 'vue'
import FormatedDateTime from '@admin/components/Table/FormatedDateTime.vue'

const { toCreateModel } = useRedirects()
const confirm = useConfirm()
const { loading, carModels, getCarModels, deleteCarModel } = useCarModel()
const filters = ref()
const { confirmAction } = useCustomConfirm()

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: {
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
            deleteCarModel(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(() => {
    getCarModels()
})
</script>
