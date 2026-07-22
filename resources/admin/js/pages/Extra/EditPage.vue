<template>
    <AppLayout>
        <PageTitle title="Edit Extra">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    primary
                    @click="toExtrasList"
                />
            </template>
        </PageTitle>
        <div class="card shadow list-page">Extra edit page</div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { Button } from 'primevue'

const { toExtrasList } = useRedirects()
</script>
