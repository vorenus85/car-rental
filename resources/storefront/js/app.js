import './bootstrap.js'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import PrimeVue from 'primevue/config'
import ToastService from 'primevue/toastservice'
import ConfirmationService from 'primevue/confirmationservice'
import { MyPreset } from './presets/MyPreset.js'
import 'primeicons/primeicons.css'
import Tooltip from 'primevue/tooltip'

import '../css/app.css'

// Your main App.vue
import App from '@storefront/App.vue'
import router from '@storefront/router/index.js'

const app = createApp(App)

app.use(createPinia())
app.use(ToastService)
app.use(ConfirmationService)
app.use(PrimeVue, {
    theme: {
        preset: MyPreset,
    },
    locale: {
        firstDayOfWeek: 1,
    },
})
app.directive('tooltip', Tooltip)
app.use(router)

app.mount('#app')
