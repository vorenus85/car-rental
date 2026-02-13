<template>
    <AppLayout>
        <PageTitle title="Edit Color">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toColorsList"
                />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <Form
                :key="formKey"
                v-slot="$form"
                :initial-values
                :resolver="colorValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1">
                    <label for="colorName">Color name</label>
                    <InputText id="colorName" name="name" type="text" placeholder="Crimson" fluid />
                    <Message
                        v-if="$form.name?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.name.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1">
                    <label for="hex_code">Color code</label>

                    <ColorPicker v-model="color" inline />
                    <div class="flex flex-col gap-1 mt-3">
                        <div class="w-50">
                            <InputGroup>
                                <InputGroupAddon :style="{ background: hexColor }">
                                </InputGroupAddon>
                                <InputText
                                    id="hexCode"
                                    v-model="hexColor"
                                    name="hex_code"
                                    type="text"
                                    fluid
                                    readonly
                                />
                            </InputGroup>
                        </div>
                    </div>
                    <Message
                        v-if="$form.hex_code?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.hex_code.error?.message }}</Message
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
import { Button, ColorPicker, InputGroup, InputGroupAddon, InputText, Message } from 'primevue'
import { useRedirects } from '@/composables/useRedirects.js'
import { useCustomToast } from '@/composables/useCustomToast'
import { Form } from '@primevue/forms'
import { useColor } from '@/composables/useColor'
import { updateColorById } from '@/services/colorService'
import { onMounted } from 'vue'
import { computed, ref } from 'vue'

const { toColorsList } = useRedirects()
const { initialValues, formKey, colorId, getColor, colorValidator } = useColor()
const { customToast } = useCustomToast()

const color = ref('ff0000')

const hexColor = computed(() => {
    return '#' + color.value
})

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        values.hex_code = color.value
        try {
            await updateColorById(colorId, values)

            customToast.success('Color updated successfully!')

            setTimeout(() => {
                toColorsList()
            }, 300)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}

onMounted(async () => {
    await getColor()
    color.value = initialValues.hex_code
})
</script>
