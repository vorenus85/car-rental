<template>
    <div class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center">
        <div class="text-xl"><strong>Log in</strong></div>
        <div class="text-center">Enter your email and password below to log in</div>

        <Form
            v-slot="$form"
            class="flex flex-col gap-4 w-full"
            :resolver="loginValidator"
            @submit="onFormSubmit"
        >
            <div class="flex flex-col gap-1 text-left">
                <label for="email">Email address</label>
                <InputText name="email" type="email" placeholder="Email address" fluid />
                <Message
                    v-if="$form.email?.invalid"
                    severity="error"
                    size="small"
                    variant="simple"
                    >{{ $form.email.error?.message }}</Message
                >
            </div>
            <div class="flex flex-col gap-1 text-left">
                <FormField v-slot="$field" name="password" class="flex flex-col gap-1">
                    <label for="password">Password</label>
                    <Password
                        type="text"
                        placeholder="Password"
                        :feedback="false"
                        toggle-mask
                        fluid
                    />
                    <Message
                        v-if="$field?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $field.error?.message }}</Message
                    >
                    <div class="text-right mb-4">
                        <RouterLink to="/forgot-password" class="font-semibold"
                            >Forgot your password?</RouterLink
                        >
                    </div>
                </FormField>
            </div>
            <Button type="submit" label="Log in" />
        </Form>
        <div class="text-center">
            <span class="text-muted-color mr-1"> Don't have an account?</span>
            <RouterLink to="register" class="font-semibold"> Sign Up</RouterLink>
        </div>
    </div>
</template>
<script setup>
import { Form, FormField } from '@primevue/forms'
import { Button, InputText, Message, Password } from 'primevue'
import { loginValidator } from '@storefront/validators/loginValidator'

const emit = defineEmits(['login-submit'])

const onFormSubmit = ({ valid, values, errors }) => {
    emit('login-submit', { valid, values, errors })
}
</script>
