<template>
    <AppLayout>
        <PageTitle title="Cars">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateCar" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">
            <DataTable
                v-model:filters="filters"
                :value="cars"
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
                <Column sortable field="image" header="Image" style="width: 5%">
                    <template #body="slotProps">
                        <div class="flex gap-1 items-center">
                            <Image
                                :src="
                                    slotProps.data?.image
                                        ? `${slotProps.data.image_url}`
                                        : '/no-image.jpg'
                                "
                                :alt="slotProps.data?.title"
                                preview
                            />
                        </div>
                    </template>
                </Column>
                <Column sortable field="id" header="Name" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex gap-1">
                            <Tag
                                :value="slotProps.data.variant.model.brand.name"
                                severity="secondary"
                                class="no-wrap"
                            />
                            <Tag
                                :value="slotProps.data.variant.model.name"
                                severity="secondary"
                                class="no-wrap"
                            />
                            <Tag
                                :value="slotProps.data.variant.name"
                                severity="secondary"
                                class="no-wrap"
                            />
                        </div>
                    </template>
                </Column>
                <Column sortable field="licence_plate" header="Plate" style="width: 10%">
                    <template #body="slotProps">
                        <Tag severity="secondary">{{ slotProps.data.licence_plate }}</Tag>
                    </template>
                </Column>
                <Column sortable field="price_per_day" header="Price/Day" style="width: 10%">
                    <template #body="slotProps">
                        <PriceTag :price="slotProps.data.price_per_day"></PriceTag>
                    </template>
                </Column>
                <Column sortable field="status" header="Status" style="width: 10%">
                    <template #body="slotProps">
                        <StatusTag :status="slotProps.data.status"></StatusTag>
                    </template>
                </Column>
                <Column sortable field="updated_at" header="Updated at" style="width: 10%">
                    <template #body="slotProps">
                        <FormatedDate :date="slotProps.data.updated_at"></FormatedDate
                    ></template>
                </Column>
                <Column header="Actions" style="width: 10%">
                    <template #body="slotProps">
                        <div class="flex items-center justify-list gap-3">
                            <Button v-slot="buttonProps" severity="info" as-child>
                                <RouterLink
                                    :to="{
                                        name: 'cars.show',
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
import { useCustomConfirm } from '@/composables/useCustomConfirm'
import { useRedirects } from '@/composables/useRedirects.js'
import { onMounted, ref } from 'vue'
import { useCar } from '@/composables/useCar'
import FormatedDate from '@/components/Table/FormatedDate.vue'
import StatusTag from '../../components/Table/StatusTag.vue'
import PriceTag from '../../components/Table/PriceTag.vue'

const { loading, getCars, cars } = useCar()
const { toCreateCar } = useRedirects()
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
            deleteFeature(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(async () => {
    await getCars()
})
</script>
