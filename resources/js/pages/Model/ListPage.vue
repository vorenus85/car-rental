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
                :value="models"
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
                        <Chip severity="primary" :label="slotProps.data.name"
                    /></template>
                </Column>
                <Column sortable field="brand.name" header="Brand" style="width: 25%">
                    <template #body="slotProps">
                        <div class="flex gap-5 items-center">
                            <Image
                                :src="
                                    slotProps.data?.brand.image
                                        ? `${slotProps.data.brand.image_url}`
                                        : '/no-image.jpg'
                                "
                                :alt="slotProps.data?.title"
                            />
                            <Chip :label="slotProps.data.brand.name" />
                        </div>
                    </template>
                </Column>
                <Column header="Actions" style="width: 25%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button v-slot="buttonProps" severity="info" as-child>
                                <RouterLink
                                    :to="{
                                        name: 'models.show',
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
    Chip,
    Column,
    DataTable,
    IconField,
    Image,
    InputIcon,
    InputText,
    useConfirm,
} from 'primevue'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import { useRedirects } from '@/composables/useRedirects.js'
import { useModel } from '@/composables/useModel'
import { useCustomConfirm } from '@/composables/useCustomConfirm'
import { onMounted, ref } from 'vue'

const { toCreateModel } = useRedirects()
const confirm = useConfirm()
const { loading, models, getModels, deleteModel } = useModel()
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
            deleteModel(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(() => {
    getModels()
})
</script>
