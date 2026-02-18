<template>
    <AppLayout>
        <PageTitle title="Add new Model">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toModelsList"
                />
            </template>
        </PageTitle>
        <div class="card">
            <Form
                v-slot="$form"
                :initial-values
                :resolver="modelValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
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
import { useCustomToast } from '@/composables/useCustomToast'
import { useModel } from '@/composables/useModel'
import { useBrand } from '@/composables/useBrand'
import { useRedirects } from '@/composables/useRedirects.js'
import { createModel } from '@/services/modelService'
import { Form } from '@primevue/forms'
import { onMounted, ref } from 'vue'

const { toModelsList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues, modelValidator } = useModel()
const { getBrandsMinimal, brands } = useBrand()
const selectedBrand = ref({})

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            values.brand_id = selectedBrand.value.id
            await createModel(values)

            customToast.success('Model created successfully!')

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
    await getBrandsMinimal()
})
</script>
