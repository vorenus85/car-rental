<template>
    <AppLayout>
        <PageTitle title="Add New Location">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toLocationsList"
                />
            </template>
        </PageTitle>
        <div class="card">
            <Form
                v-slot="$form"
                :initial-values="initialValues"
                :resolver="locationValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
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
                <div
                    v-for="(day, key) in initialValues.business_hours"
                    :key="key"
                    class="flex items-center gap-3"
                >
                    <Checkbox
                        v-model="day.enabled"
                        :name="`business_hours.${key}.enabled`"
                        binary
                        :input-id="`${key}-enabled`"
                    />

                    <label :for="`${key}-enabled`" class="w-24">
                        {{ day.label }}
                    </label>

                    <DatePicker
                        v-model="day.open"
                        :name="`business_hours[${key}][open]`"
                        :disabled="!day.enabled"
                        time-only
                        hour-format="24"
                        show-icon
                    >
                        <template #inputicon="slotProps">
                            <i class="pi pi-clock" @click="slotProps.clickCallback" />
                        </template>
                    </DatePicker>

                    <span>-</span>

                    <DatePicker
                        v-model="day.close"
                        :name="`business_hours[${key}][close]`"
                        :disabled="!day.enabled"
                        time-only
                        hour-format="24"
                        show-icon
                    >
                        <template #inputicon="slotProps">
                            <i class="pi pi-clock" @click="slotProps.clickCallback" />
                        </template>
                    </DatePicker>

                    <input type="hidden" :name="`business_hours[${key}][day]`" :value="key" />
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
                    <label for="is_active">Is active</label>
                    <ToggleSwitch name="is_active" />
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
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import {
    Button,
    Checkbox,
    DatePicker,
    FileUpload,
    InputText,
    Message,
    ProgressBar,
    Select,
    Textarea,
    ToggleSwitch,
} from 'primevue'
import { useCustomToast } from '@/composables/useCustomToast'
import { useRedirects } from '@/composables/useRedirects.js'
import { locationValidator } from '@/validators/locationValidator.js'
import { createLocation } from '@/services/locationService'
import { useLocation } from '@/composables/useLocation'
import { Form } from '@primevue/forms'
import { ref } from 'vue'

const { toLocationsList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues, groupedCities, locationTypes } = useLocation()

const onFormSubmit = async ({ valid, values, errors }) => {
    values.country = values.city_country.code
    values.city = values.city_country.value

    console.log(values)
    if (valid) {
        try {
            await createLocation(values)

            customToast.success('Location created successfully!')

            setTimeout(() => {
                toLocationsList()
            }, 300)
        } catch (error) {
            console.log(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
