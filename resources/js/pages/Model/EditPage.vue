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
                <div class="flex flex-col gap-1">
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
                <div class="flex flex-col gap-1">
                    <label for="brand">Brand</label>
                    <Select
                        id="brand"
                        v-model="selectedBrand"
                        filter
                        :options="brands"
                        option-label="name"
                        placeholder="Select Brand"
                        checkmark
                        name="brand"
                        :highlight-on-select="false"
                        class="w-full md:w-56"
                    />
                    <Message
                        v-if="$form.brand?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.brand?.error?.message }}</Message
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
import { Button, InputText, Message, Select } from 'primevue'
import { useRedirects } from '@/composables/useRedirects.js'
import { Form } from '@primevue/forms'
import { useCustomToast } from '@/composables/useCustomToast'
import { useModel } from '@/composables/useModel'
import { useBrand } from '@/composables/useBrand'
import { updateModelById } from '@/services/modelService'
import { onMounted, ref } from 'vue'

const { toModelsList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues, modelValidator, formKey, modelId, getModel } = useModel()
const { getBrandsMinimal, brands } = useBrand()
const selectedBrand = ref({})

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            values.brand_id = selectedBrand.value.id
            await updateModelById(modelId, values)

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
    await getModel()
    await getBrandsMinimal()
    // console.log(initialValues)
    selectedBrand.value = {
        id: initialValues.brand.id,
        name: initialValues.brand.name,
    }

    console.log(selectedBrand.value)
})
</script>
