<template>
    <div class="container mx-auto px-6">
        <div class="grid gap-6 items-start xl:grid-cols-3">
            <div
                class="lg:col-span-1 xl:col-span-1 space-y-10 rounded-3xl bg-white p-8 lg:p-10 shadow-xl border border-slate-200 h-full"
            >
                <!-- Heading -->
                <div>
                    <h2
                        class="mt-4 text-4xl lg:text-5xl font-extrabold text-[#061324] leading-tight"
                    >
                        Get in Touch
                    </h2>

                    <p class="mt-5 text-lg leading-8 text-slate-600 max-w-xl">
                        Have a question about reservations, pricing, vehicle availability, or
                        anything else? Our team is here to help.
                    </p>
                </div>

                <!-- Contact cards -->
                <div class="space-y-5">
                    <!-- Phone -->
                    <div class="flex items-start gap-5 mb-5 pb-5">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-full bg-[#fcb102]/10"
                        >
                            <i class="pi pi-phone text-2xl text-[#fcb102]"></i>
                        </div>

                        <div>
                            <h3 class="font-semibold text-[#061324]">Phone</h3>

                            <p class="mt-1 text-slate-600">Call us anytime.</p>

                            <a
                                href="tel:+3612345678"
                                class="mt-2 inline-block text-[#061324] hover:text-[#fcb102]"
                            >
                                +36 1 234 5678
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-5 mb-5 pb-5">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-full bg-[#fcb102]/10"
                        >
                            <i class="pi pi-envelope text-2xl text-[#fcb102]"></i>
                        </div>

                        <div>
                            <h3 class="font-semibold text-[#061324]">Email</h3>

                            <p class="mt-1 text-slate-600">Send us your inquiry.</p>

                            <a
                                href="mailto:info@drivengo.com"
                                class="mt-2 inline-block text-[#061324] hover:text-[#fcb102]"
                            >
                                info@drivengo.com
                            </a>
                        </div>
                    </div>

                    <!-- Office -->
                    <div class="flex items-start gap-5 mb-5 pb-5">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-full bg-[#fcb102]/10"
                        >
                            <i class="pi pi-map-marker text-2xl text-[#fcb102]"></i>
                        </div>

                        <div>
                            <h3 class="font-semibold text-[#061324]">Office</h3>

                            <p class="mt-1 text-slate-600 leading-7">
                                1062 Budapest<br />

                                Váci Road 1-3<br />

                                Hungary
                            </p>
                        </div>
                    </div>

                    <!-- Office -->
                    <div class="flex items-start gap-5">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-full bg-[#fcb102]/10"
                        >
                            <i class="pi pi-clock text-2xl text-[#fcb102]"></i>
                        </div>

                        <div>
                            <h3 class="font-semibold text-[#061324]">Working Hours</h3>

                            <p class="mt-1 text-slate-600 leading-7">
                                Mon - Fri: 08:00 - 20:00<br />
                                Sat - Sun: 09:00 - 18:00
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                id="contact-form"
                class="lg:col-span-1 xl:col-span-2 rounded-3xl bg-white p-8 lg:p-10 shadow-xl border border-slate-200 h-full"
            >
                <!-- Heading -->
                <div class="mb-8">
                    <h2
                        class="mt-4 text-4xl lg:text-5xl font-extrabold text-[#061324] leading-tight"
                    >
                        Send Us a Message
                    </h2>

                    <p class="mt-3 text-slate-600 leading-7">
                        Fill out the form below and our team will get back to you as soon as
                        possible.
                    </p>
                </div>

                <Form
                    ref="formRef"
                    v-slot="$form"
                    class="space-y-6"
                    :resolver="contactValidator"
                    :validate-on-value-update="true"
                    :validate-on-blur="true"
                    @submit="onFormSubmit"
                >
                    <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                        <!-- Name -->
                        <div>
                            <label
                                for="fullName"
                                class="mb-2 block text-sm font-semibold text-[#061324]"
                            >
                                Full Name
                            </label>

                            <InputText
                                id="fullName"
                                name="name"
                                class="w-full"
                                placeholder="John Doe"
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

                        <!-- Email -->
                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold text-[#061324]"
                            >
                                Email Address
                            </label>

                            <InputText
                                id="email"
                                name="email"
                                type="email"
                                class="w-full"
                                placeholder="john@example.com"
                                fluid
                            />
                            <Message
                                v-if="$form.email?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.email.error?.message }}</Message
                            >
                        </div>
                    </div>

                    <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                        <!-- Phone -->
                        <div>
                            <label
                                for="phone"
                                class="mb-2 block text-sm font-semibold text-[#061324]"
                            >
                                Phone Number
                            </label>

                            <InputText
                                id="phone"
                                name="phone"
                                class="w-full"
                                placeholder="+36 30 123 4567"
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

                        <!-- Subject -->
                        <div>
                            <label
                                for="subject"
                                class="mb-2 block text-sm font-semibold text-[#061324]"
                            >
                                Subject
                            </label>

                            <InputText
                                id="subject"
                                name="subject"
                                class="w-full"
                                placeholder="How can we help?"
                                fluid
                            />
                            <Message
                                v-if="$form.subject?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.subject.error?.message }}</Message
                            >
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label
                            for="message"
                            class="mb-2 block text-sm font-semibold text-[#061324]"
                        >
                            Message
                        </label>

                        <Textarea
                            id="message"
                            name="message"
                            rows="6"
                            auto-resize
                            class="w-full"
                            placeholder="Write your message here..."
                            fluid
                        />
                        <Message
                            v-if="$form.message?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                            >{{ $form.message.error?.message }}</Message
                        >
                    </div>

                    <!-- Submit -->
                    <Button
                        type="submit"
                        label="Send Message"
                        icon="pi pi-send"
                        icon-pos="right"
                        class="w-full lg:w-auto px-8 py-4"
                        size="large"
                        :loading="isSubmitting"
                    />
                </Form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import { Form } from '@primevue/forms'
import { Button, InputText, Message, Textarea } from 'primevue'
import { useCustomToast } from '@storefront/composables/useCustomToast'
import { sendContactMessage } from '@storefront/services/contactService'
import { contactValidator } from '@storefront/validators/contactValidator'

const { customToast } = useCustomToast()
const formRef = ref(null)
const isSubmitting = ref(false)

const onFormSubmit = async ({ valid, values, errors }) => {
    if (!valid) {
        customToast.error(`${Object.keys(errors).length} field contains errors`)

        return
    }

    try {
        isSubmitting.value = true

        const { data } = await sendContactMessage(values)

        formRef.value?.reset()

        customToast.success(data?.message || 'Your message has been sent.')
    } catch (error) {
        const msg = error?.response?.data?.message
        customToast.error(msg || 'Please try again.')
    } finally {
        isSubmitting.value = false
    }
}
</script>
