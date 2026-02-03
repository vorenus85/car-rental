import { defineStore } from 'pinia'

export const useWebStore = defineStore('web', {
    state: () => ({
        count: 0,
    }),
    actions: {
        increment() {
            this.count++
        },
    },
})
