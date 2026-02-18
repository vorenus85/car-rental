<template>
    <AppLayout>
        <PageTitle title="Edit Brand">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toBrandsList"
                />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <Form
                v-slot="$form"
                :initial-values
                :resolver="brandValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
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

                    <template v-if="initialValues.image">
                        <div class="flex items-center gap-5">
                            <Image
                                :src="
                                    initialValues?.image
                                        ? `${initialValues.image_url}`
                                        : '/no-image.jpg'
                                "
                                :alt="initialValues?.name"
                                width="90"
                                preview
                            />
                            <Button
                                icon="pi pi-trash"
                                severity="danger"
                                aria-label="Delete image"
                                @click="deleteImage()"
                            />
                        </div>
                    </template>
                    <template v-if="!initialValues.image">
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
                    </template>
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
import { Button, FileUpload, Image, InputText, Message, ProgressBar } from 'primevue'
import { useCustomToast } from '@/composables/useCustomToast'
import { useBrand } from '@/composables/useBrand'
import { useRedirects } from '@/composables/useRedirects.js'
import { updateBrandById } from '@/services/brandService'
import { Form } from '@primevue/forms'
import { onMounted } from 'vue'

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
    getBrand,
    formKey,
    deleteImage,
    brandId,
} = useBrand()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            values.image = uploadedImage.value
            await updateBrandById(brandId, values)

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

onMounted(async () => {
    await getBrand()
})
</script>
