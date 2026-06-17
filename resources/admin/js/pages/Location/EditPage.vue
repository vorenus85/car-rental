<template>
    <AppLayout>
        <PageTitle title="Edit Location">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toLocationsList"
                />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <Form
                :key="formKey"
                v-slot="$form"
                :initial-values="initialValues"
                :resolver="locationValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 mb-4">
                    <label for="name">Name</label>
                    <InputText
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Budapest Airport Terminal 2"
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
                <div class="flex flex-col gap-1 mb-4">
                    <label for="city_country">City & Country</label>
                    <Select
                        input-id="city_country"
                        name="city_country"
                        :options="groupedCities"
                        option-label="label"
                        option-group-label="label"
                        option-group-children="items"
                        placeholder="Select a City"
                        class="w-full md:w-56"
                    >
                        <template #optiongroup="slotProps">
                            <div class="flex items-center">
                                <img
                                    :alt="slotProps.option.label"
                                    src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png"
                                    :class="`mr-2 flag flag-${slotProps.option.code.toLowerCase()}`"
                                    style="width: 18px"
                                />
                                <div>{{ slotProps.option.label }}</div>
                            </div>
                        </template>
                    </Select>
                    <Message
                        v-if="$form.city_country?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.city_country.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4">
                    <label for="address">Address</label>
                    <InputText
                        id="address"
                        name="address"
                        type="text"
                        placeholder="123 Main Street"
                        fluid
                    />
                    <Message
                        v-if="$form.address?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.address.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4">
                    <label for="address">Business hours</label>
                    <div
                        v-for="(day, key) in initialValues.business_hours"
                        :key="key"
                        class="flex items-center gap-3"
                    >
                        <Checkbox
                            v-model="day.enabled"
                            :name="`business_hours.${key}.enabled`"
                            binary
                            readonly
                            :input-id="`${key}-enabled`"
                        />

                        <label :for="`${key}-enabled`" class="w-24">
                            <small>{{ day.label }}</small>
                        </label>

                        <div class="">
                            <DatePicker
                                v-model="day.open"
                                :name="`business_hours[${key}][open]`"
                                :disabled="!day.enabled"
                                time-only
                                readonly
                                hour-format="24"
                                show-icon
                                class="business-hours"
                            >
                                <template #inputicon="slotProps">
                                    <i class="pi pi-clock" @click="slotProps.clickCallback" />
                                </template>
                            </DatePicker>
                        </div>

                        <span>-</span>

                        <div class="">
                            <DatePicker
                                v-model="day.close"
                                :name="`business_hours[${key}][close]`"
                                :disabled="!day.enabled"
                                time-only
                                readonly
                                hour-format="24"
                                show-icon
                                class="business-hours"
                            >
                                <template #inputicon="slotProps">
                                    <i class="pi pi-clock" @click="slotProps.clickCallback" />
                                </template>
                            </DatePicker>
                        </div>

                        <input type="hidden" :name="`business_hours[${key}][day]`" :value="key" />
                    </div>
                </div>

                <div class="flex flex-col gap-1 mb-4">
                    <label for="type">Type</label>
                    <Select
                        input-id="type"
                        name="type"
                        :options="locationTypes"
                        option-value="id"
                        option-label="label"
                        placeholder="Select type"
                        :highlight-on-select="false"
                        checkmark
                        class="w-full md:w-56"
                    ></Select>
                    <Message
                        v-if="$form.type?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.type?.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4">
                    <label for="phone">Phone</label>
                    <InputText
                        id="phone"
                        name="phone"
                        type="text"
                        placeholder="123-456-7890"
                        fluid
                    />
                    <Message
                        v-if="$form.phone?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.phone.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4">
                    <label for="email">Email</label>
                    <InputText
                        id="email"
                        name="email"
                        type="text"
                        placeholder="location@example.com"
                        fluid
                    />
                    <Message
                        v-if="$form.email?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.email.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4">
                    <label for="active">Is active</label>
                    <ToggleSwitch name="active" />
                </div>
                <div class="flex flex-col gap-1 mb-4">
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
    DatePicker,
    InputText,
    Message,
    Select,
    Textarea,
    ToggleSwitch,
} from 'primevue'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { locationValidator } from '@admin/validators/locationValidator.js'
import { updateLocationById } from '@admin/services/locationService'
import { useLocation } from '@admin/composables/useLocation'
import { Form } from '@primevue/forms'
import { onMounted } from 'vue'

const { toLocationsList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues, groupedCities, locationTypes, locationId, getLocation, formKey } =
    useLocation()

const onFormSubmit = async ({ valid, values, errors }) => {
    values.country = values.city_country.code
    values.city_id = values.city_country.value

    if (valid) {
        try {
            await updateLocationById(locationId, values)

            customToast.success('Location updated successfully!')

            setTimeout(() => {
                toLocationsList()
            }, 300)
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
    await getLocation()
})
</script>
<style>
.business-hours input {
    max-width: 150px;
}
</style>
