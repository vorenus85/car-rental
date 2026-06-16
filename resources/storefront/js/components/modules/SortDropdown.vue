<template>
    <Select
        v-model="selectedSort"
        :options="sortOptions"
        option-label="label"
        option-value="value"
        placeholder="Sort by"
        class="w-full md:w-72"
        @change="onChange"
    >
        <template #value="{ value }">
            <div v-if="value" class="flex items-center gap-2">
                <i :class="findOption(value)?.icon"></i>
                <span>{{ findOption(value)?.label }}</span>
            </div>

            <span v-else> Sort by </span>
        </template>

        <template #option="{ option }">
            <div class="flex items-center gap-2">
                <i :class="option.icon"></i>
                <span>{{ option.label }}</span>
            </div>
        </template>
    </Select>
</template>

<script setup>
import { Select } from 'primevue'
import { ref } from 'vue'

const selectedSort = ref('price_desc')

const emit = defineEmits(['change'])

const sortOptions = [
    {
        label: 'Price: High to Low',
        value: 'price_desc',
        icon: 'pi pi-sort-amount-down',
    },
    {
        label: 'Price: Low to High',
        value: 'price_asc',
        icon: 'pi pi-sort-amount-up',
    },
    {
        label: 'Year: Newest First',
        value: 'year_desc',
        icon: 'pi pi-calendar-plus',
    },
    {
        label: 'Year: Oldest First',
        value: 'year_asc',
        icon: 'pi pi-calendar-minus',
    },
]

const findOption = value => {
    return sortOptions.find(option => option.value === value)
}

const onChange = () => {
    emit('change', selectedSort.value)
}
</script>
