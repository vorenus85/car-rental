<template>
    <AppLayout>
        <PageTitle title="Add new Variant">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toVariantsList"
                />
            </template>
        </PageTitle>
        <div class="card">
            <Form
                ref="formRef"
                v-slot="$form"
                :initial-values="initialValues"
                :resolver="variantValidator"
                class="flex flex-col gap-4 w-full"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="name">Variant name</label>
                    <InputText
                        id="name"
                        name="name"
                        type="text"
                        placeholder="1.0 MPI Manual"
                        fluid
                    />
                    <Message
                        v-if="$form.name?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.name.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
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
                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="model">Model</label>
                    <Select
                        input-id="model"
                        filter
                        :options="carModels"
                        option-value="id"
                        option-label="name"
                        placeholder="Select model"
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
                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="category">Category</label>
                    <small class="p-text-secondary">
                        Select the vehicle category. This determines pricing tier and positioning
                        (Economy, Compact, SUV, Business, Premium).
                    </small>
                    <Select
                        id="category"
                        filter
                        :options="variantCategories"
                        option-value="id"
                        option-label="label"
                        placeholder="Select category"
                        checkmark
                        name="category"
                        :highlight-on-select="false"
                        class="w-full md:w-56"
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
                    <label for="body_type">Body type</label>
                    <Select
                        id="body_type"
                        filter
                        :options="bodyTypes"
                        option-value="id"
                        option-label="label"
                        placeholder="Select body type"
                        checkmark
                        name="body_type"
                        :highlight-on-select="false"
                        class="w-full md:w-56"
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
                    <label for="transmission">Transmission</label>
                    <SelectButton
                        name="transmission"
                        :options="transmissions"
                        option-label="label"
                        option-value="id"
                        aria-labelledby="basic"
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
                    <label for="fuel">Fuel type</label>
                    <Select
                        id="fuel"
                        filter
                        :options="fuelTypes"
                        option-value="id"
                        option-label="label"
                        placeholder="Select fuel type"
                        checkmark
                        name="fuel"
                        :highlight-on-select="false"
                        class="w-full md:w-56"
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
                    <label for="seats">Seats</label>
                    <div class="w-1/2">
                        <div>
                            <InputText
                                v-model="initialValues.seats"
                                name="seats"
                                class="w-10 mb-4"
                            />
                            <div class="px-3 mb-4">
                                <Slider
                                    v-model="initialValues.seats"
                                    class="w-full"
                                    :min="1"
                                    :max="9"
                                />
                            </div>
                        </div>
                        <Message
                            v-if="$form.seats?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.seats?.error?.message }}</Message
                        >
                    </div>
                </div>
                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="seats">Doors</label>
                    <div class="w-1/2">
                        <div>
                            <InputText
                                v-model="initialValues.doors"
                                name="doors"
                                class="w-10 mb-4"
                            />
                            <div class="px-3 mb-4">
                                <Slider
                                    v-model="initialValues.doors"
                                    class="w-full"
                                    :min="1"
                                    :max="5"
                                />
                            </div>
                        </div>
                        <Message
                            v-if="$form.doors?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.doors?.error?.message }}</Message
                        >
                    </div>
                </div>

                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="luggage_count">Luggage count</label>
                    <div class="w-1/2">
                        <div>
                            <InputText
                                v-model="initialValues.luggage_count"
                                name="luggage_count"
                                class="w-10 mb-4"
                            />
                            <div class="px-3 mb-4">
                                <Slider
                                    v-model="initialValues.luggage_count"
                                    class="w-full"
                                    :min="1"
                                    :max="5"
                                />
                            </div>
                        </div>
                        <Message
                            v-if="$form.luggage_count?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.luggage_count?.error?.message }}</Message
                        >
                    </div>
                </div>

                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="range_km">Range</label>
                    <div class="w-1/2">
                        <InputGroup>
                            <InputNumber id="range_km" name="range_km" placeholder="Range" />
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
                <div class="flex flex-col w-full lg:w-1/2">
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
    InputGroup,
    InputGroupAddon,
    InputNumber,
    InputText,
    Message,
    Select,
    SelectButton,
    Slider,
    Textarea,
} from 'primevue'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { Form } from '@primevue/forms'
import { useBrand } from '@admin/composables/useBrand'
import { useCarModel } from '@admin/composables/useCarModel'
import { useVariant } from '@admin/composables/useVariant'
import { createVariant } from '@admin/services/variantService'
import { variantValidator } from '@admin/validators/variantValidator'
import { onMounted, ref, watch } from 'vue'
import { useCustomToast } from '@admin/composables/useCustomToast'

const { getBrands, brands } = useBrand()
const { getCarModelsByBrand, carModels } = useCarModel()
const { variantCategories, bodyTypes, transmissions, fuelTypes, initialValues, selectedBrand } =
    useVariant()
const { toVariantsList } = useRedirects()
const { customToast } = useCustomToast()
const formRef = ref(null)

watch(selectedBrand, newValue => {
    if (formRef.value) {
        formRef.value.setFieldValue('model_id', null)
    }

    if (newValue) {
        getCarModelsByBrand({ brand_id: newValue })
    } else {
        carModels.value = []
    }
})

const onFormSubmit = async ({ valid, values, errors }) => {
    values.seats = initialValues.seats
    values.doors = initialValues.doors
    values.luggage_count = initialValues.luggage_count
    if (valid) {
        try {
            await createVariant(values)

            customToast.success('Variant created successfully!')

            toVariantsList()
        } catch (error) {
            // console.error(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}

onMounted(async () => {
    await getBrands()
})
</script>
