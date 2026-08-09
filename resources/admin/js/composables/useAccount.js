import { reactive, ref } from 'vue'
import { fetchMe } from '@admin/services/accountService'
import { useRouter } from 'vue-router'

export const useAccount = () => {
    const formKey = ref(0)
    const password = ref(null)
    const password_confirmation = ref(null)
    const router = useRouter()
    const accountMenu = ref([
        {
            label: 'Profile',
            route: '/account/profile',
            command: () => router.push('/account/profile'),
        },
        {
            label: 'Password',
            route: '/account/password',
            command: () => router.push('/account/password'),
        },
    ])

    const initialValues = reactive({
        name: '',
        email: '',
        phone: '',
    })

    const getProfile = async () => {
        try {
            const { data } = await fetchMe()
            initialValues.name = data.name
            initialValues.phone = data.phone
            initialValues.email = data.email
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
        } catch (e) {
            void e
            // console.error(e) -- IGNORE --
        }
    }

    return {
        accountMenu,
        getProfile,
        initialValues,
        password,
        password_confirmation,
        formKey,
    }
}
