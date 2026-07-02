<template>
    <Stepper class="booking-steps" :value="active" linear>
        <StepList>
            <Step v-for="(item, index) in items" :key="index" :value="index + 1">
                {{ item.label }}
            </Step>
        </StepList>
    </Stepper>
</template>

<script setup>
import Stepper from 'primevue/stepper'
import StepList from 'primevue/steplist'
import Step from 'primevue/step'

defineProps({
    active: {
        type: Number,
        default: 1,
    },
})

const items = [
    { label: 'Extras and Insurance' },
    { label: 'Driver Information' },
    { label: 'Payment and Confirmation' },
    { label: 'Successful Booking' },
]
</script>

<style scoped>
.booking-stepper {
    width: 100%;
}
</style>
<style lang="scss">
.booking-steps {
    --p-stepper-step-number-active-background: var(--primary-color);
    --p-stepper-step-number-active-border-color: var(--primary-color);
    --p-stepper-step-number-active-color: #fff;
}
</style>
