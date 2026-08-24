<template>
    <div class="space-y-4 mt-5 pt-5 pb-5 mb-5">
        <div class="flex items-start gap-3">
            <Checkbox v-model="acceptTerms" input-id="terms" binary />

            <label for="terms" class="text-sm text-surface-700 leading-5 cursor-pointer">
                I accept the
                <a
                    href="/terms-and-conditions"
                    target="_blank"
                    class="font-medium text-secondary hover:underline"
                >
                    Terms &amp; Conditions
                </a>
                <span class="text-red-500">*</span>
            </label>
        </div>

        <div class="flex items-start gap-3">
            <Checkbox v-model="acceptPrivacy" input-id="privacy" binary />

            <label for="privacy" class="text-sm text-surface-700 leading-5 cursor-pointer">
                I accept the
                <a
                    href="/privacy-policy"
                    target="_blank"
                    class="font-medium text-secondary hover:underline"
                >
                    Privacy Policy
                </a>
                <span class="text-red-500">*</span>
            </label>
        </div>
    </div>
</template>
<script setup>
import { Checkbox } from 'primevue'
import { computed } from 'vue'

const props = defineProps({
    acceptTerms: {
        type: Boolean,
        default: false,
    },
    acceptPrivacy: {
        type: Boolean,
        default: false,
    },
})

const emit = defineEmits(['update:acceptTerms', 'update:acceptPrivacy'])

const acceptTerms = computed({
    get: () => props.acceptTerms,
    set: value => emit('update:acceptTerms', value),
})

const acceptPrivacy = computed({
    get: () => props.acceptPrivacy,
    set: value => emit('update:acceptPrivacy', value),
})
</script>
