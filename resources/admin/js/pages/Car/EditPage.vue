<template>
    <AppLayout>
        <PageTitle title="Edit Car">
            <template #actions>
                <Button icon="pi pi-angle-left" label="Back to list" primary @click="toCarsList" />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
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
                    <div class="font-semibold text-xl mb-2">Basic Informations</div>
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
                    <div class="font-semibold text-xl mb-2">Variant informations</div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="body_type">Body Type </label>
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
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="luggage_count">Luggage count </label>
                        <InputText
                            v-model="selectedLuggageCount"
                            input-id="luggage_count"
                            name="luggage_count"
                            type="text"
                            placeholder="Luggage"
                            fluid
                            readonly
                        />
                        <Message
                            v-if="$form.luggage_count?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.luggage_count?.error?.message }}</Message
                        >
                    </div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="range_km">Range </label>
                        <InputGroup>
                            <InputNumber
                                id="range_km"
                                v-model="selectedRangeKm"
                                name="range_km"
                                placeholder="Range"
                            />
                            <InputGroupAddon>km</InputGroupAddon>
                        </InputGroup>
                        <Message
                            v-if="$form.range_km?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.range_km?.error?.message }}</Message
                        >
                    </div>
                </div>
                <div class="mb-4">
                    <div class="font-semibold text-xl mb-2">Unit informations</div>
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
                    <div class="font-semibold text-xl mb-2">Unit features</div>
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
                                        v-model="initialValues.features"
                                        name="features[]"
                                        :input-id="'feature-' + feature.id"
                                        :value="feature.id"
                                    />

                                    <label :for="'feature-' + feature.id">
                                        <span class="font-normal">{{ feature.name }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="font-semibold text-xl mb-2">Rental Information</div>
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
                    <div class="flex flex-col gap-1 mb-4">
                        <label for="location">Location</label>
                        <Select
                            id="location"
                            filter
                            :options="locations"
                            option-value="id"
                            option-label="name"
                            placeholder="Select Location"
                            checkmark
                            name="location_id"
                            :highlight-on-select="false"
                            class="w-full md:w-56"
                        />
                        <Message
                            v-if="$form.location_id?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.location_id?.error?.message }}</Message
                        >
                    </div>
                </div>
                <div class="mb-4">
                    <div class="font-semibold text-xl mb-2">Media and description</div>
                    <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                        <label for="description">Image</label>
                        <template v-if="initialValues.image">
                            <div class="flex items-center gap-5">
                                <Image
                                    :src="
                                        initialValues?.image
                                            ? `${initialValues.image_url}`
                                            : '/no-image.jpg'
                                    "
                                    :alt="initialValues?.name"
                                    width="150"
                                    preview
                                />
                                <Button
                                    icon="pi pi-trash"
                                    severity="danger"
                                    aria-label="Delete image"
                                    @click="deleteImage()"
                                />
                            </div>
                        </template>
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
                            id="description"
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
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import {
    Button,
    Checkbox,
    FileUpload,
    Image,
    InputGroup,
    InputGroupAddon,
    InputNumber,
    InputText,
    Message,
    ProgressBar,
    Select,
    Textarea,
} from 'primevue'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { Form } from '@primevue/forms'
import { useCar } from '@admin/composables/useCar'
import { useBrand } from '@admin/composables/useBrand'
import { useCarModel } from '@admin/composables/useCarModel'
import { useFeature } from '@admin/composables/useFeature'
import { useVariant } from '@admin/composables/useVariant'
import { useLocation } from '@admin/composables/useLocation'
import { updateCarById } from '@admin/services/carService'
import { carValidator } from '@admin/validators/carValidator'
import { onMounted, ref, watch } from 'vue'
import CarColorSelect from '@admin/components/CarColorSelect.vue'
import { useCustomToast } from '@admin/composables/useCustomToast'

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
    getCar,

    selectedBodyType,
    selectedTransmission,
    selectedFuelType,
    selectedSeats,
    selectedDoors,
    selectedLuggageCount,
    selectedRangeKm,
    carId,
    deleteImage,
    formKey,
} = useCar()

const { customToast } = useCustomToast()
const { toCarsList } = useRedirects()
const { getLocationOptions, locations } = useLocation()
const { getBrands, brands } = useBrand()
const { getCarModelsByBrand, carModels } = useCarModel()
const { groupedFeatures, getFeatures } = useFeature()
const {
    bodyTypes,
    transmissions,
    fuelTypes,
    selectedBrand,
    selectedCarModel,
    selectedVariant,
    getVariantsByCarmodel,
    variants,
    getVariantById,
} = useVariant()

watch(selectedBrand, newValue => {
    selectedCarModel.value = null
    selectedVariant.value = null
    selectedBodyType.value = null
    selectedTransmission.value = null
    selectedFuelType.value = null
    selectedSeats.value = null
    selectedDoors.value = null
    selectedLuggageCount.value = null
    selectedRangeKm.value = null

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
    selectedBodyType.value = null
    selectedTransmission.value = null
    selectedFuelType.value = null
    selectedSeats.value = null
    selectedDoors.value = null
    selectedLuggageCount.value = null
    selectedRangeKm.value = null

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
    selectedBodyType.value = null
    selectedTransmission.value = null
    selectedFuelType.value = null
    selectedSeats.value = null
    selectedDoors.value = null
    selectedLuggageCount.value = null
    selectedRangeKm.value = null

    if (newValue) {
        const result = await getVariantById(newValue)

        selectedBodyType.value = bodyTypes.find(item => item.id === result.body_type)?.label ?? ''
        selectedTransmission.value =
            transmissions.find(item => item.id === result.transmission)?.label ?? ''
        selectedFuelType.value = fuelTypes.find(item => item.id === result.fuel)?.label ?? ''

        selectedSeats.value = result.seats
        selectedDoors.value = result.doors
        selectedLuggageCount.value = result.luggage_count
        selectedRangeKm.value = result.range_km

        // selectedFeatures.value = result.features.map(f => f.id)
    }
})

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            values.image = uploadedImage?.value || null
            await updateCarById(carId, values)

            customToast.success('Car updated successfully!')

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

const initializeEditForm = async () => {
    selectedBrand.value = initialValues.brand_id

    await getCarModelsByBrand({
        brand_id: initialValues.brand_id,
    })

    selectedCarModel.value = initialValues.model_id

    await getVariantsByCarmodel({
        model_id: initialValues.model_id,
    })

    selectedVariant.value = initialValues.variant_id

    if (formRef.value) {
        Object.entries(initialValues).forEach(([key, value]) => {
            formRef.value.setFieldValue(key, value)
        })
    }
}

onMounted(async () => {
    await Promise.all([getBrands(), getFeatures(), getLocationOptions()])
    await getCar()
    await initializeEditForm()
})
</script>
