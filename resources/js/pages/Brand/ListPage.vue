<template>
    <AppLayout>
        <PageTitle title="Brands">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateBrand" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="brands"
                paginator
                :rows="20"
                :rows-per-page-options="[20, 50]"
                table-style="min-width: 50rem"
                :loading="loading"
                :global-filter-fields="['name']"
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
                <Column sortable field="image" header="Logo" style="width: 10%">
                    <template #body="slotProps">
                        <Image
                            :src="
                                slotProps.data?.image
                                    ? `${slotProps.data.image_url}`
                                    : '/no-image.jpg'
                            "
                            :alt="slotProps.data?.title"
                            preview
                        />
                    </template>
                </Column>
                <Column sortable field="name" header="Name" style="width: 25%">
                    <template #body="slotProps"> <Chip :label="slotProps.data.name" /></template>
                </Column>
                <Column header="Actions" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button v-slot="buttonProps" severity="info" as-child>
                                <RouterLink
                                    :to="{
                                        name: 'brands.show',
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
import { useBrand } from '@/composables/useBrand.js'
import { useRedirects } from '@/composables/useRedirects.js'
import { useCustomConfirm } from '@/composables/useCustomConfirm'
import { onMounted, ref } from 'vue'

const filters = ref()
const { toCreateBrand } = useRedirects()
const confirm = useConfirm()
const { confirmAction } = useCustomConfirm()
const { loading, brands, getBrands, deleteBrand } = useBrand()

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
            deleteBrand(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(async () => {
    await getBrands()
})
</script>
