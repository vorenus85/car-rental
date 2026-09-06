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
                    <div class="flex justify-start gap-5">
                        <Button
                            class="mr-auto"
                            width="80px"
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
                        <div class="max-sm:hidden">
                            <Select
                                v-model="selectedCarStatus"
                                filter
                                :options="rentalStatuses"
                                option-label="name"
                                placeholder="Select a Status"
                                show-clear
                                @change="changeCarStatusFilter"
                            >
                            </Select>
                        </div>
                    </div>
                </template>
                <template #empty> No results found. </template>
                <Column sortable field="image" header="Image" style="width: 5%">
                    <template #body="slotProps">
                        <RouterLink
                            :to="{
                                name: 'cars.show',
                                params: {
                                    id: slotProps.data?.id,
                                },
                            }"
                        >
                            <Image
                                :src="
                                    slotProps.data?.image
                                        ? `${slotProps.data.image_url}`
                                        : '/no-image.jpg'
                                "
                                :alt="slotProps.data?.title"
                            />
                        </RouterLink>
                    </template>
                </Column>

                <Column sortable field="licence_plate" header="Plate" style="width: 10%">
                    <template #body="slotProps">
                        <Tag severity="secondary" class="no-wrap">
                            {{ slotProps.data.licence_plate }}
                        </Tag>
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

                <Column sortable field="location.city" header="City" style="width: 5%">
                    <template #body="slotProps">
                        <Tag severity="secondary" class="no-wrap">
                            {{ slotProps.data.location.city }}
                        </Tag>
                    </template>
                </Column>

                <Column sortable field="location.name" header="Location" style="width: 10%">
                    <template #body="slotProps">
                        <Tag severity="secondary" class="no-wrap">
                            {{ slotProps.data.location.name }}
                        </Tag>
                    </template>
                </Column>

                <Column sortable field="variant.body_type" header="Body" style="width: 10%">
                    <template #body="slotProps">
                        <Tag severity="secondary" class="no-wrap">
                            {{ slotProps.data.variant.body_type }}
                        </Tag>
                    </template>
                </Column>

                <Column sortable field="production_year" header="Year" style="width: 10%">
                    <template #body="slotProps">
                        {{ slotProps.data.production_year }}
                    </template>
                </Column>

                <Column sortable field="mileage" header="Mileage" style="width: 10%">
                    <template #body="slotProps">
                        <span class="no-wrap">{{ slotProps.data.mileage }} km </span>
                    </template>
                </Column>

                <Column sortable field="price_per_day" header="Price/Day" style="width: 10%">
                    <template #body="slotProps">
                        <PriceTag :price="slotProps.data.price_per_day"></PriceTag>
                    </template>
                </Column>

                <Column sortable field="status" header="Status" style="width: 10%">
                    <template #body="slotProps">
                        <CarStatusTag :status="slotProps.data.status"></CarStatusTag>
                    </template>
                </Column>

                <Column sortable field="updated_at" header="Updated at" style="width: 10%">
                    <template #body="slotProps">
                        <FormatedDateTime :date="slotProps.data.updated_at"></FormatedDateTime
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
                                    name: 'cars.show',
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
    Select,
    Tag,
    useConfirm,
} from 'primevue'
import { FilterMatchMode, FilterOperator } from '@primevue/core/api'
import { useCustomConfirm } from '@admin/composables/useCustomConfirm'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { onMounted, ref, watch } from 'vue'
import { useCar } from '@admin/composables/useCar'
import { useRoute, useRouter } from 'vue-router'
import FormatedDateTime from '@admin/components/Table/FormatedDateTime.vue'
import CarStatusTag from '@admin/components/Table/CarStatusTag.vue'
import PriceTag from '@admin/components/Table/PriceTag.vue'

const { loading, getCars, cars, deleteCar, rentalStatuses } = useCar()
const route = useRoute()
const router = useRouter()
const { toCreateCar } = useRedirects()
const confirm = useConfirm()
const { confirmAction } = useCustomConfirm()
const filters = ref()
const selectedCarStatus = ref(null)

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
    selectedCarStatus.value = null

    const query = { ...route.query }
    delete query.status

    router.push({ query })
}

const syncSelectedCarStatusFromQuery = () => {
    const status = route.query.status
    selectedCarStatus.value = rentalStatuses.find(item => item.id === status) || null
}

const changeCarStatusFilter = event => {
    const status = event?.value?.id ?? null
    selectedCarStatus.value = event?.value ?? null
    const query = { ...route.query }

    if (status) {
        query.status = status
    } else {
        delete query.status
    }

    router.push({ query })
}

const deleteConfirm = id => {
    confirmAction(confirm, {
        action: () => {
            deleteCar(id)
        },
        acceptLabel: 'Delete',
    })
}

onMounted(async () => {
    syncSelectedCarStatusFromQuery()
    await getCars()
})

watch(
    () => route.query,
    async () => {
        syncSelectedCarStatusFromQuery()
        await getCars()
    },
    { deep: true }
)
</script>
