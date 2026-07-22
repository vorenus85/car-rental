<template>
    <AppLayout>
        <PageTitle title="Extras">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateExtra" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">Extra list page</div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { Button } from 'primevue'

const { toCreateExtra } = useRedirects()
</script>
