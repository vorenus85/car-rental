import Aura from '@primeuix/themes/aura'
import { definePreset } from '@primeuix/themes'

export const MyPreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: '#fff9e6',
            100: '#fff1bf',
            200: '#ffe680',
            300: '#ffda40',
            400: '#ffcb1a',
            500: '#fcb102',
            600: '#e6a102',
            700: '#cc8f01',
            800: '#b37d01',
            900: '#996b01',
            950: '#664700',
        },
    },
})
