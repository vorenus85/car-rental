<template>
    <div
        class="car-search rounded-xl border p-6 border-gray-200 bg-white shadow-sm mx-auto max-w-8xl"
    >
        <div class="grid">
            <div class="field">
                <label for="pick-up-location" class="text-lg">Pick-up Location</label>

                <InputGroup>
                    <InputGroupAddon>
                        <i class="pi pi-map-marker" />
                    </InputGroupAddon>

                    <Select
                        v-model="form.location"
                        :options="groupedLocations"
                        input-id="pick-up-location"
                        option-group-label="label"
                        option-group-children="items"
                        option-label="label"
                        option-value="value"
                        filter
                        placeholder="Select location"
                        class="w-full"
                    >
                        <template #optiongroup="slotProps">
                            <div class="flex items-center">
                                <img
                                    :alt="slotProps.option.label"
                                    src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png"
                                    :class="`mr-2 flag flag-${slotProps?.option?.code?.toLowerCase()}`"
                                    style="width: 18px"
                                />
                                <div>{{ slotProps.option.label }}</div>
                            </div>
                        </template>
                    </Select>
                </InputGroup>
            </div>

            <div class="field">
                <label class="text-lg">Pick-up Date</label>

                <InputGroup>
                    <InputGroupAddon>
                        <i class="pi pi-calendar" />
                    </InputGroupAddon>
                    <DatePicker
                        v-model="form.pickupDate"
                        :min-date="minPickUpDate"
                        icon-display="input"
                        date-format="yy-mm-dd"
                        class="w-full"
                    />
                </InputGroup>
            </div>

            <div class="field">
                <label class="text-lg">Pick-up Time</label>

                <InputGroup>
                    <InputGroupAddon> <i class="pi pi-clock" /></InputGroupAddon
                    ><DatePicker
                        v-model="form.pickupTime"
                        time-only
                        icon-display="input"
                        class="w-full"
                        :mindate="minTime"
                        :max-date="maxTime"
                        :step-minute="30"
                /></InputGroup>
            </div>

            <div class="field">
                <label class="text-lg">Drop-off Date</label>
                <InputGroup>
                    <InputGroupAddon> <i class="pi pi-calendar" /> </InputGroupAddon
                    ><DatePicker
                        v-model="form.dropoffDate"
                        :min-date="mindropOffDate"
                        icon-display="input"
                        date-format="yy-mm-dd"
                        class="w-full"
                /></InputGroup>
            </div>

            <div class="field">
                <label class="text-lg">Drop-off Time</label>
                <InputGroup>
                    <InputGroupAddon> <i class="pi pi-clock" /> </InputGroupAddon
                    ><DatePicker
                        v-model="form.dropoffTime"
                        :mindate="minTime"
                        :max-date="maxTime"
                        :step-minute="30"
                        time-only
                        icon-display="input"
                        class="w-full"
                /></InputGroup>
            </div>

            <div class="field button-wrapper">
                <Button label="Search Cars" size="large" class="w-full" @click="searchCars" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { Button, DatePicker, InputGroup, InputGroupAddon, Select } from 'primevue'
import { onMounted, ref } from 'vue'
import { useLocation } from '@storefront/composables/useLocation'
import { useRouter } from 'vue-router'
import { formatDate, formatTime } from '@storefront/utils.js'

const router = useRouter()
const { getLocations, groupedLocations } = useLocation()
const defaultPickUpDate = ref(new Date())
const minPickUpDate = new Date()

const dropOffDate = new Date()
dropOffDate.setDate(dropOffDate.getDate() + 3)
const mindropOffDate = new Date()
mindropOffDate.setDate(mindropOffDate.getDate() + 1)

const defaultDropOffDate = ref(dropOffDate)

defaultPickUpDate.value.setHours(0, 0, 0, 0)
defaultDropOffDate.value.setHours(0, 0, 0, 0)

const minTime = new Date()
minTime.setHours(10, 0, 0, 0)
const defaultPickUpTime = new Date()
defaultPickUpTime.setHours(10, 0, 0, 0)

const maxTime = new Date()
maxTime.setHours(20, 0, 0, 0)
const defaultDropOffTime = new Date()
defaultDropOffTime.setHours(10, 0, 0, 0)

const form = ref({
    location: null,
    pickupDate: defaultPickUpDate,
    pickupTime: defaultPickUpTime,
    dropoffDate: defaultDropOffDate,
    dropoffTime: defaultDropOffTime,
})

const searchCars = () => {
    router.push({
        path: '/fleet',
        query: {
            ...(form.value.location && {
                'location-id': form.value.location,
            }),
            'pick-up-date': formatDate(form.value.pickupDate),
            'pick-up-time': formatTime(form.value.pickupTime),
            'drop-off-date': formatDate(form.value.dropoffDate),
            'drop-off-time': formatTime(form.value.dropoffTime),
        },
    })
}

onMounted(() => {
    getLocations()
})
</script>

<style scoped>
.car-search {
    background: var(--surface-card);
    position: relative;
    z-index: 1;
    margin-top: -3rem;
    margin-bottom: 1rem;
}

.grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
    gap: 1rem;
    align-items: end;
}

.field {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.button-wrapper {
    min-width: 180px;
}

@media (max-width: 1200px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .button-wrapper {
        min-width: auto;
    }
}

@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }
}
</style>
