<template>
    <AppLayout>
        <PageTitle title="Edit Feature">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toFeaturesList"
                />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <Form
                :key="formKey"
                v-slot="$form"
                :initial-values
                :resolver="featureValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1">
                    <label for="name">Feature name</label>
                    <InputText
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Air Conditioning"
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
                <div class="flex flex-col gap-1">
                    <label for="description">Feature description</label>
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
import { Form } from '@primevue/forms'
import { Button, InputText, Message, Textarea } from 'primevue'
import { useFeature } from '@/composables/useFeature'
import { useCustomToast } from '@/composables/useCustomToast'
import { updateFeatureById } from '@/services/featureService'
import { useRedirects } from '@/composables/useRedirects.js'
import { onMounted } from 'vue'

const { toFeaturesList } = useRedirects()
const { initialValues, formKey, featureId, getFeature, featureValidator } = useFeature()
const { customToast } = useCustomToast()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await updateFeatureById(featureId, values)

            customToast.success('Feature updated successfully!')

            setTimeout(() => {
                toFeaturesList()
            }, 300)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}

onMounted(async () => {
    await getFeature()
})
</script>
