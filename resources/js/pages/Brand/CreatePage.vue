<template>
    <AppLayout>
        <PageTitle title="Add new Brand">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toBrandsList"
                />
            </template>
        </PageTitle>
        <div class="card">
            <Form
                v-slot="$form"
                :initial-values
                :resolver="brandValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1">
                    <label for="name">Brand name</label>
                    <InputText id="name" name="name" type="text" placeholder="Aston Martin" fluid />
                    <Message
                        v-if="$form.name?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.name.error?.message }}</Message
                    >
                </div>

                <InputText name="image" type="hidden" />

                <div class="flex flex-col gap-1">
                    <label for="description">Brand logo</label>
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
import ProgressBar from 'primevue/progressbar'
import { Button, FileUpload, InputText, Message } from 'primevue'
import { useCustomToast } from '@/composables/useCustomToast'
import { useBrand } from '@/composables/useBrand'
import { createBrand } from '@/services/brandService'
import { useRedirects } from '@/composables/useRedirects.js'
import { Form } from '@primevue/forms'

const { toBrandsList } = useRedirects()
const { customToast } = useCustomToast()

const {
    initialValues,
    brandValidator,
    isUploading,
    uploadProgress,
    onRemoveImage,
    onClearUploaderStatus,
    onImageUpload,
    uploadedImage,
} = useBrand()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            values.image = uploadedImage.value
            await createBrand(values)

            customToast.success('Feature created successfully!')

            setTimeout(() => {
                toBrandsList()
            }, 300)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}
</script>
