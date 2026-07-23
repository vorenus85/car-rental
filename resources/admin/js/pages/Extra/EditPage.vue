<template>
    <AppLayout>
        <PageTitle title="Edit Extra">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    severity="secondary"
                    outlined
                    link
                    size="small"
                    @click="toExtrasList"
                />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <Form
                :key="formKey"
                v-slot="$form"
                :initial-values
                :resolver="extraValidator"
                class="flex flex-col gap-4 w-full lg:w-1/2"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 mb-4">
                    <label for="name">Extra name</label>
                    <InputText id="name" name="name" type="text" placeholder="Child Seat" fluid />
                    <Message
                        v-if="$form.name?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.name.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="price_per_day">Price/ Day </label>
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
                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="maxQuantity">Max quantity </label>
                    <InputGroup>
                        <InputNumber id="maxQuantity" name="maxQuantity" placeholder="1" />
                    </InputGroup>
                    <Message
                        v-if="$form.maxQuantity?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.maxQuantity?.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4 w-full lg:w-1/2">
                    <label for="icon">Icon postfix</label>
                    <p class="mt-1 text-sm text-surface-500 dark:text-surface-400">
                        Enter the PrimeIcons name without the
                        <code class="rounded bg-surface-100 px-1 py-0.5 text-xs dark:bg-surface-800"
                            >pi pi-</code
                        >
                        prefix (e.g.
                        <code class="rounded bg-surface-100 px-1 py-0.5 text-xs dark:bg-surface-800"
                            >heart</code
                        >,
                        <code class="rounded bg-surface-100 px-1 py-0.5 text-xs dark:bg-surface-800"
                            >car</code
                        >). See the
                        <a
                            href="https://primevue.org/icons/"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="font-medium text-primary hover:underline"
                        >
                            PrimeIcons documentation </a
                        >.
                    </p>
                    <InputText id="icon" name="icon" type="text" placeholder="shield" fluid />
                    <Message
                        v-if="$form.icon?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.icon.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 mb-4">
                    <label for="description">Extra description</label>
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
} from 'primevue'
import { extraValidator } from '@admin/validators/extraValidator'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { updateExtraById } from '@admin/services/extraService'
import { Form } from '@primevue/forms'
import { useExtra } from '@admin/composables/useExtra'
import { onMounted } from 'vue'

const { customToast } = useCustomToast()
const { toExtrasList } = useRedirects()
const { initialValues, formKey, extraId, getExtra } = useExtra()

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            await updateExtraById(extraId, values)

            customToast.success('Extra updated successfully!')

            setTimeout(() => {
                toExtrasList()
            }, 300)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}

onMounted(async () => {
    await getExtra()
})
</script>
