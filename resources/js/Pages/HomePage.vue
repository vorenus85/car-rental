<template>
    <AppLayout>
        <h2 class="text-2xl font-bold">Welcome 👋</h2>
        <p class="mt-2 text-gray-600">AppLayout works 🎉</p>
        <div>
            <h2 class="text-xl font-bold">API Response:</h2>
            <pre>{{ data }}</pre>
        </div>
        <Button label="PrimeVue OK" icon="pi pi-check" />
    </AppLayout>
</template>

<script setup>
import Button from 'primevue/button'
import AppLayout from '@/Layouts/AppLayout.vue'

import { ref, onMounted } from 'vue'
import axios from 'axios'

const data = ref(null)

onMounted(async () => {
    const res = await axios.get('/api/home')
    data.value = res.data
})
</script>
