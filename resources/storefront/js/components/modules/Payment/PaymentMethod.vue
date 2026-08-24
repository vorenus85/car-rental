<template>
    <div
        class="payment-types rounded-2xl border border-surface-200 bg-white p-5 md:p-6 space-y-5 mt-5"
    >
        <div class="space-y-4">
            <h2 class="text-lg font-semibold">Payment method</h2>

            <!-- stripe -->
            <div
                class="border border-surface-200 background-white rounded-xl p-5"
                :class="paymentMethod === 'stripe' ? 'border-primary' : ''"
            >
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <RadioButton v-model="paymentMethod" input-id="stripe" value="stripe" />

                        <label
                            for="stripe"
                            class="cursor-pointer"
                            :class="paymentMethod === 'stripe' ? 'font-semibold' : ''"
                        >
                            Credit / Debit Card
                        </label>
                    </div>

                    <div class="flex gap-2">
                        <img :src="'/images/payment/visa.svg'" class="h-7" alt="visa" />
                        <img :src="'/images/payment/mastercard.svg'" class="h-7" alt="mastercard" />
                        <img :src="'/images/payment/maestro.svg'" class="h-7" alt="maestro" />
                    </div>
                </div>

                <div v-if="paymentMethod === 'stripe'" class="mt-5 space-y-4">
                    <div>
                        <label for="card" class="text-sm text-gray-600"> Card Number </label>

                        <InputText
                            v-model="card.number"
                            input-id="card"
                            class="w-full mt-1"
                            placeholder="1234 5678 9012 3456"
                        />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="expire-date" class="text-sm text-gray-600">
                                Expiry Date
                            </label>

                            <InputText
                                v-model="card.expiry"
                                input-id="expire-date"
                                class="w-full mt-1"
                                placeholder="MM / YY"
                            />
                        </div>

                        <div>
                            <label for="ccv" class="text-sm text-gray-600"> CVC / CVV </label>

                            <InputText
                                v-model="card.cvc"
                                input-id="ccv"
                                class="w-full mt-1"
                                placeholder="123"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="holder" class="text-sm text-gray-600"> Cardholder Name </label>

                        <InputText
                            v-model="card.holder"
                            input-id="holder"
                            class="w-full mt-1"
                            placeholder="JOHN SINCLAIR"
                        />
                    </div>
                </div>
            </div>

            <!-- Cash -->
            <label
                for="cash"
                class="border rounded-xl p-4 cursor-pointer block border-surface-200 background-white"
                :class="paymentMethod === 'cash' ? 'border-primary' : ''"
            >
                <div class="flex items-center gap-3">
                    <RadioButton v-model="paymentMethod" input-id="cash" value="cash" />

                    <span :class="paymentMethod === 'cash' ? 'font-semibold' : ''"
                        >Pay cash on Pickup</span
                    >
                </div>

                <p class="text-sm text-gray-500 mt-2 ml-8">
                    The full amount is payable in cash when you pick up the vehicle.
                </p>
            </label>
        </div>
    </div>
</template>
<script setup>
import { InputText, RadioButton } from 'primevue'
import { computed, ref } from 'vue'

const props = defineProps({
    modelValue: {
        type: String,
        default: 'stripe',
    },
})

const emit = defineEmits(['update:modelValue'])

const paymentMethod = computed({
    get: () => props.modelValue,
    set: value => emit('update:modelValue', value),
})

const card = ref({
    number: '',
    expiry: '',
    cvc: '',
    holder: '',
})
</script>
