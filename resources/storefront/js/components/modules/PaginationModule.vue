<template>
    <Paginator
        v-if="totalRecords > rows"
        :first="first"
        :rows="rows"
        :total-records="totalRecords"
        @page="onPage"
    />
</template>

<script setup>
import Paginator from 'primevue/paginator'
import { computed } from 'vue'

const props = defineProps({
    currentPage: {
        type: Number,
        required: true,
    },
    perPage: {
        type: Number,
        required: true,
    },
    total: {
        type: Number,
        required: true,
    },
})

const emit = defineEmits(['change'])

const first = computed(() => {
    return (props.currentPage - 1) * props.perPage
})

const rows = computed(() => props.perPage)

const totalRecords = computed(() => props.total)

const onPage = event => {
    emit('change', event.page + 1)
}
</script>
<style>
.p-paginator {
    --p-paginator-background: transparent;
}
</style>
