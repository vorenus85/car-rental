<template>
    <Dialog v-model:visible="visible" modal header=" " :style="{ width: '28rem' }">
        <LoginPanel @login-submit="onFormSubmit"></LoginPanel>
    </Dialog>
</template>
<script setup>
import { Dialog } from 'primevue'
import LoginPanel from '@storefront/components/modules/LoginPanel.vue'

const visible = defineModel({
    default: false,
})

const emit = defineEmits(['login-submit'])

const onFormSubmit = ({ valid, values, errors }) => {
    emit('login-submit', { valid, values, errors })
}
</script>
