<template>
    <AppLayout>
        <PageTitle title="Add new Car">
            <template #actions>
                <Button icon="pi pi-angle-left" label="Back to list" primary @click="toCarsList" />
            </template>
        </PageTitle>
        <div class="card">
            <Form
                ref="formRef"
                v-slot="$form"
                :initial-values
                :resolver="carValidator"
                class="flex flex-col gap-4 w-full"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                @submit="onFormSubmit"
            >
                <div class="mb-4">
                    <div class="font-semibold text-xl">Basic Informations</div>
                    <div class="flex flex-col gap-1 mb-4">
                        <label for="brand">Brand</label>
                        <Select
                            v-model="selectedBrand"
                            input-id="brand"
                            filter
                            :options="brands"
                            option-value="id"
                            option-label="name"
                            placeholder="Select Brand"
                            checkmark
                            name="brand_id"
                            :highlight-on-select="false"
                            class="w-full md:w-56"
                        />
                        <Message
                            v-if="$form.brand_id?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.brand_id?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4">
                        <label for="carModel">Model</label>
                        <Select
                            v-model="selectedCarModel"
                            input-id="carModel"
                            filter
                            :options="carModels"
                            option-value="id"
                            option-label="name"
                            placeholder="Select Model"
                            checkmark
                            name="model_id"
                            :highlight-on-select="false"
                            class="w-full md:w-56"
                        />
                        <Message
                            v-if="$form.model_id?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.model_id?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4">
                        <label for="variant">Variant</label>
                        <Select
                            v-model="selectedVariant"
                            input-id="variant"
                            filter
                            :options="variants"
                            option-value="id"
                            option-label="name"
                            placeholder="Select Variant"
                            checkmark
                            name="variant_id"
                            :highlight-on-select="false"
                            class="w-full md:w-56"
                        />
                        <Message
                            v-if="$form.variant_id?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.variant_id?.error?.message }}</Message
                        >
                    </div>
                </div>

                <div class="mb-4">
                    <div class="font-semibold text-xl mb-3">Variant informations</div>
                    <Message severity="info" class="mb-5">
                        Variant specifications are automatically populated based on the selected
                        Brand, Model, and Variant. These values are read-only on this page.
                    </Message>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="category">Category </label>
                        <InputText
                            v-model="selectedCategory"
                            input-id="category"
                            name="category"
                            type="text"
                            placeholder="Category"
                            fluid
                            readonly
                        />
                        <Message
                            v-if="$form.category?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.category?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="category">Body Type </label>
                        <InputText
                            v-model="selectedBodyType"
                            input-id="body_type"
                            name="body_type"
                            type="text"
                            placeholder="Body Type"
                            fluid
                            readonly
                        />
                        <Message
                            v-if="$form.body_type?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.body_type?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="transmission">Transmission </label>
                        <InputText
                            v-model="selectedTransmission"
                            input-id="transmission"
                            name="transmission"
                            type="text"
                            placeholder="Transmission"
                            fluid
                            readonly
                        />
                        <Message
                            v-if="$form.transmission?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.transmission?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="fuel">Fuel </label>
                        <InputText
                            v-model="selectedFuelType"
                            input-id="fuel"
                            name="fuel"
                            type="text"
                            placeholder="Fuel"
                            fluid
                            readonly
                        />
                        <Message
                            v-if="$form.fuel?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.fuel?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="seats">Seats </label>
                        <InputText
                            v-model="selectedSeats"
                            input-id="seats"
                            name="seats"
                            type="text"
                            placeholder="Seats"
                            fluid
                            readonly
                        />
                        <Message
                            v-if="$form.seats?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.seats?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="doors">Doors </label>
                        <InputText
                            v-model="selectedDoors"
                            input-id="doors"
                            name="doors"
                            type="text"
                            placeholder="Doors"
                            fluid
                            readonly
                        />
                        <Message
                            v-if="$form.doors?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.doors?.error?.message }}</Message
                        >
                    </div>
                </div>
                <div class="mb-4">
                    <div class="font-semibold text-xl">Unit informations</div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="licence_plate">Licence Plate </label>
                        <InputText
                            id="licence_plate"
                            name="licence_plate"
                            type="text"
                            placeholder="Plate number"
                            fluid
                        />
                        <Message
                            v-if="$form.licence_plate?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.licence_plate?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="color">Color </label>
                        <CarColorSelect :value="$form.color?.value" name="color" />
                        <Message
                            v-if="$form.color?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.color?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="production_year">Production Year </label>
                        <InputNumber
                            id="production_year"
                            name="production_year"
                            placeholder="2020"
                            fluid
                        />
                        <Message
                            v-if="$form.production_year?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.production_year?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="mileage">Mileage </label>
                        <InputGroup>
                            <InputNumber id="mileage" name="mileage" placeholder="Mileage" />
                            <InputGroupAddon>km</InputGroupAddon>
                        </InputGroup>
                        <Message
                            v-if="$form.mileage?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.mileage?.error?.message }}</Message
                        >
                    </div>
                </div>
                <div class="mb-4">
                    <div class="font-semibold text-xl">Unit features</div>
                    <Message severity="info" class="mb-5">
                        The selected Variant provides a predefined set of vehicle features. These
                        values are automatically applied to streamline vehicle creation and may be
                        customized as needed.</Message
                    >
                    <div class="flex flex-col gap-2">
                        <div v-for="category in groupedFeatures" :key="category.id">
                            <strong class="mb-2">{{ category.label }}</strong>

                            <div
                                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-4"
                            >
                                <div
                                    v-for="feature in category.features"
                                    :key="feature.id"
                                    class="flex gap-2"
                                >
                                    <Checkbox
                                        v-model="selectedFeatures"
                                        name="features"
                                        :input-id="'feature-' + feature.id"
                                        :value="feature.id"
                                    />

                                    <label :for="'feature-' + feature.id">
                                        {{ feature.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="font-semibold text-xl">Rental Information</div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="price_per_day">Price/ Day </label>
                        <InputGroup>
                            <InputNumber
                                id="price_per_day"
                                name="price_per_day"
                                placeholder="Price"
                            />
                            <InputGroupAddon>€</InputGroupAddon>
                        </InputGroup>
                        <Message
                            v-if="$form.price_per_day?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.price_per_day?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4">
                        <label for="variant">Status</label>
                        <Select
                            id="status"
                            filter
                            :options="rentalStatuses"
                            option-value="id"
                            option-label="name"
                            placeholder="Select Status"
                            checkmark
                            name="status"
                            :highlight-on-select="false"
                            class="w-full md:w-56"
                        />
                        <Message
                            v-if="$form.status?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.status?.error?.message }}</Message
                        >
                    </div>
                </div>
                <div class="mb-4">
                    <div class="font-semibold text-xl">Media and description</div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="description">Image</label>
                        <div class="file-upload-clean">
                            <FileUpload
                                name="file"
                                custom-upload
                                :multiple="false"
                                accept="image/*"
                                :max-file-size="1000000"
                                :disabled="isUploading || !!uploadedImage"
                                @uploader="onImageUpload"
                                @remove="onRemoveImage"
                                @clear="onClearUploaderStatus"
                            />
                        </div>
                        <ProgressBar v-if="isUploading" :value="uploadProgress" />
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="description">Description</label>
                        <Textarea
                            name="description"
                            rows="5"
                            cols="30"
                            style="resize: none"
                            placeholder=""
                        />
                        <Message
                            v-if="$form.description?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.description.error?.message }}</Message
                        >
                    </div>
                </div>

                <div class="flex flex-col">
                    <Button
                        type="submit"
                        severity="primary"
                        label="Save"
                        class="ml-auto"
                        size="large"
                        style="width: 150px"
                    />
                </div>
            </Form>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import {
    Button,
    Checkbox,
    FileUpload,
    InputGroup,
    InputGroupAddon,
    InputNumber,
    InputText,
    Message,
    ProgressBar,
    Select,
    Textarea,
} from 'primevue'
import { useRedirects } from '@/composables/useRedirects.js'
import { Form } from '@primevue/forms'
import { useCar } from '@/composables/useCar'
import { useBrand } from '@/composables/useBrand'
import { useCarModel } from '@/composables/useCarModel'
import { useFeature } from '@/composables/useFeature'
import { useVariant } from '@/composables/useVariant'
import { createCar } from '@/services/carService'
import { carValidator } from '@/validators/carValidator'
import { onMounted, ref, watch } from 'vue'
import CarColorSelect from '@/components/CarColorSelect.vue'
import { useCustomToast } from '@/composables/useCustomToast'

const formRef = ref(null)

const {
    initialValues,
    isUploading,
    uploadProgress,
    onRemoveImage,
    onClearUploaderStatus,
    onImageUpload,
    uploadedImage,
    rentalStatuses,

    selectedCategory,
    selectedBodyType,
    selectedTransmission,
    selectedFuelType,
    selectedSeats,
    selectedDoors,
} = useCar()

const { customToast } = useCustomToast()
const { toCarsList } = useRedirects()
const { getBrands, brands } = useBrand()
const { getCarModelsByBrand, carModels } = useCarModel()
const { groupedFeatures, getFeatures } = useFeature()
const {
    variantCategories,
    bodyTypes,
    transmissions,
    fuelTypes,
    selectedBrand,
    selectedCarModel,
    selectedVariant,
    getVariantsByCarmodel,
    variants,
    getVariantById,
    selectedFeatures,
} = useVariant()

watch(selectedBrand, newValue => {
    selectedCarModel.value = null
    selectedVariant.value = null
    selectedCategory.value = null
    selectedBodyType.value = null
    selectedTransmission.value = null
    selectedFuelType.value = null
    selectedSeats.value = null
    selectedDoors.value = null
    selectedFeatures.value = null

    if (formRef.value) {
        formRef.value.setFieldValue('model_id', null)
        formRef.value.setFieldValue('variant_id', null)
    }

    if (newValue) {
        getCarModelsByBrand({ brand_id: newValue })
    } else {
        carModels.value = []
        variants.value = []
    }
})

watch(selectedCarModel, newValue => {
    selectedVariant.value = null
    selectedCategory.value = null
    selectedBodyType.value = null
    selectedTransmission.value = null
    selectedFuelType.value = null
    selectedSeats.value = null
    selectedDoors.value = null
    selectedFeatures.value = null

    if (formRef.value) {
        formRef.value.setFieldValue('variant_id', null)
    }

    if (newValue) {
        getVariantsByCarmodel({ model_id: newValue })
    } else {
        variants.value = []
    }
})

watch(selectedVariant, async newValue => {
    selectedCategory.value = null
    selectedBodyType.value = null
    selectedTransmission.value = null
    selectedFuelType.value = null
    selectedSeats.value = null
    selectedDoors.value = null
    selectedFeatures.value = null

    if (newValue) {
        const result = await getVariantById(newValue)

        selectedCategory.value =
            variantCategories.find(item => item.id === result.category)?.label ?? ''

        selectedBodyType.value = bodyTypes.find(item => item.id === result.body_type)?.label ?? ''
        selectedTransmission.value =
            transmissions.find(item => item.id === result.transmission)?.label ?? ''
        selectedFuelType.value = fuelTypes.find(item => item.id === result.fuel)?.label ?? ''

        selectedSeats.value = result.seats
        selectedDoors.value = result.doors

        selectedFeatures.value = result.features.map(f => f.id)
    }
})

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            values.image = uploadedImage?.value || null
            await createCar(values)

            customToast.success('Car created successfully!')

            setTimeout(() => {
                toCarsList()
            }, 300)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}

onMounted(async () => {
    await getBrands()
    await getFeatures()
})
</script>
