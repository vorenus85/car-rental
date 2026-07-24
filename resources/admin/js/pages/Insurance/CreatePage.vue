<template>
    <AppLayout>
        <PageTitle title="Add new Insurance">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    severity="secondary"
                    outlined
                    link
                    size="small"
                    @click="toInsurancesList"
                />
            </template>
        </PageTitle>
        <div class="card">
            <Form
                v-slot="$form"
                :initial-values
                :resolver="insuranceValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 mb-4">
                    <label for="name">Insurance name</label>
                    <InputText
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Premium insurance"
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
                    <label for="price">Price/ Day </label>
                    <InputGroup>
                        <InputNumber id="price" name="price" placeholder="Price" />
                        <InputGroupAddon>€</InputGroupAddon>
                    </InputGroup>
                    <Message
                        v-if="$form.price?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.price?.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4">
                    <label for="description">Insurance description</label>
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
                <div class="flex flex-col gap-1 mb-4">
                    <label for="active">Is recommended</label>
                    <ToggleSwitch name="recommended" />
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
import { useRedirects } from '@admin/composables/useRedirects.js'
import {
    Button,
    InputGroup,
    InputGroupAddon,
    InputNumber,
    InputText,
    Message,
    Textarea,
    ToggleSwitch,
} from 'primevue'
import { insuranceValidator } from '@admin/validators/insuranceValidator'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { Form } from '@primevue/forms'
import { useInsurance } from '@admin/composables/useInsurance'
import { createInsurance } from '@admin/services/insuranceService'

const { customToast } = useCustomToast()
const { toInsurancesList } = useRedirects()
const { initialValues } = useInsurance()

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            await createInsurance(values)

            customToast.success('Insurance created successfully!')

            setTimeout(() => {
                toInsurancesList()
            }, 300)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
