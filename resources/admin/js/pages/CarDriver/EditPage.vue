<template>
    <AppLayout>
        <PageTitle title="Edit Driver">
            <template #back>
                <Button
                    icon="pi pi-angle-left"
                    severity="secondary"
                    size="large"
                    @click="toCarDriversList"
                />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <Form
                v-slot="$form"
                :initial-values="initialValues"
                :resolver="carDriverValidator"
                class="flex flex-col gap-4 w-full"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="mb-4">
                    <div class="font-semibold text-xl">Personal Information</div>
                </div>
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="firstName">First Name</label>
                    <InputText
                        id="firstName"
                        name="firstName"
                        type="text"
                        placeholder="Simon"
                        fluid
                    />
                    <Message
                        v-if="$form.firstName?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.firstName.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="lastName">Last Name</label>
                    <InputText
                        id="lastName"
                        name="lastName"
                        type="text"
                        placeholder="Baker"
                        fluid
                    />
                    <Message
                        v-if="$form.lastName?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.lastName.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="phone">Phone</label>
                    <InputText
                        id="phone"
                        name="phone"
                        type="text"
                        placeholder="06 123 456 789"
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
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="birthDate">Birth Date</label>
                    <DatePicker
                        id="birthDate"
                        v-model="initialValues.birthDate"
                        name="birthDate"
                        class="w-full"
                        show-icon
                        date-format="yy. mm. dd."
                        placeholder="YYYY. MM. DD."
                        :max-date="maxBirthDate"
                        :manual-input="false"
                    />
                    <Message
                        v-if="$form.birthDate?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.birthDate.error?.message }}</Message
                    >
                    <Message severity="info" icon="pi pi-info-circle" class="mt-6">
                        Minimum driver age is 25 years.
                    </Message>
                </div>

                <div class="mb-4 mt-4">
                    <div class="font-semibold text-xl">Driving Licence</div>
                </div>

                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="licenceNumber">Licence Number</label>
                    <InputText
                        id="licenceNumber"
                        name="licenceNumber"
                        type="text"
                        placeholder="ABC123"
                        fluid
                    />
                    <Message
                        v-if="$form.licenceNumber?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.licenceNumber.error?.message }}</Message
                    >
                </div>

                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="licenceCountry">Issuing country</label>
                    <Select
                        id="licenceCountry"
                        v-model="initialValues.licenceCountry"
                        name="licenceCountry"
                        :options="countryOptions"
                        option-label="name"
                        option-value="code"
                        filter
                        class="w-full"
                        placeholder="Select issuing country"
                    >
                        <template #option="{ option }">
                            <div class="flex items-center gap-3">
                                <span
                                    :class="`fi fi-${option.code.toLowerCase()}`"
                                    style="border-radius: 2px"
                                />
                                {{ option.name }}
                            </div>
                        </template>

                        <template #value="{ value }">
                            <div v-if="value" class="flex items-center gap-3">
                                <span :class="`fi fi-${value.toLowerCase()}`" />
                                {{ getCountryName(value) }}
                            </div>

                            <span v-else>Select country</span>
                        </template>
                    </Select>
                    <Message
                        v-if="$form.licenceCountry?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.licenceCountry.error?.message }}</Message
                    >
                </div>

                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="licenceIssueDate">Issue Date</label>
                    <DatePicker
                        id="licenceIssueDate"
                        v-model="initialValues.licenceIssueDate"
                        name="licenceIssueDate"
                        class="w-full"
                        show-icon
                        date-format="yy-mm-dd"
                        placeholder="YYYY-MM-DD"
                        :manual-input="false"
                        :max-date="maxLicenceDate"
                    />
                    <Message
                        v-if="$form.licenceIssueDate?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.licenceIssueDate.error?.message }}</Message
                    >
                </div>

                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="licenceExpiryDate">Expiry Date</label>
                    <DatePicker
                        id="licenceExpiryDate"
                        v-model="initialValues.licenceExpiryDate"
                        name="licenceExpiryDate"
                        class="w-full"
                        show-icon
                        date-format="yy-mm-dd"
                        placeholder="YYYY-MM-DD"
                        :manual-input="false"
                        :min-date="new Date()"
                    />
                    <Message
                        v-if="$form.licenceExpiryDate?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.licenceExpiryDate.error?.message }}</Message
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
import { countryOptions, getCountryName, formatDate } from '@admin/utils.js'
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { Form } from '@primevue/forms'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { useCarDriver } from '@admin/composables/useCarDriver.js'
import { Button, DatePicker, InputText, Message, Select } from 'primevue'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { updateCarDriverById } from '@admin/services/carDriverService'
import { carDriverValidator } from '@admin/validators/carDriverValidator'
import { onMounted } from 'vue'

const { toCarDriversList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues, maxBirthDate, maxLicenceDate, carDriverId, formKey, getCarDriver } =
    useCarDriver()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            values.birthDate = formatDate(values.birthDate)
            values.licenceIssueDate = formatDate(values.licenceIssueDate)
            values.licenceExpiryDate = formatDate(values.licenceExpiryDate)
            await updateCarDriverById(carDriverId, values)

            customToast.success('Car Driver updated successfully!')

            toCarDriversList()
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}

onMounted(async () => {
    await getCarDriver(carDriverId)
})
</script>
