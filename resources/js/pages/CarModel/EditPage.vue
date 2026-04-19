<template>
    <AppLayout>
        <PageTitle title="Edit Model">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toModelsList"
                />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <Form
                :key="formKey"
                v-slot="$form"
                :initial-values
                :resolver="modelValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 mb-4">
                    <label for="name">Model name</label>
                    <InputText id="name" name="name" type="text" placeholder="Crimson" fluid />
                    <Message
                        v-if="$form.name?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.name.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4">
                    <label for="brand">Brand</label>
                    <Select
                        id="brand"
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
                    <label for="description">Description</label>
                    <Textarea
                        id="description"
                        rows="5"
                        cols="30"
                        placeholder="Model description"
                        name="description"
                    />
                    <Message
                        v-if="$form.description?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.description?.error?.message }}</Message
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
import { Button, InputText, Message, Select, Textarea } from 'primevue'
import { useRedirects } from '@/composables/useRedirects.js'
import { Form } from '@primevue/forms'
import { useCustomToast } from '@/composables/useCustomToast'
import { useCarModel } from '@/composables/useCarModel'
import { useBrand } from '@/composables/useBrand'
import { updateCarModelById } from '@/services/carModelService'
import { onMounted } from 'vue'

const { toModelsList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues, modelValidator, formKey, modelId, getCarModel } = useCarModel()
const { getBrands, brands } = useBrand()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await updateCarModelById(modelId, values)

            customToast.success('Model updated successfully!')

            setTimeout(() => {
                toModelsList()
            }, 300)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}
onMounted(async () => {
    await getCarModel()
    await getBrands()
})
</script>
