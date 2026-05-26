import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { fetchMe } from '@/services/accountService'

export const useAccount = () => {
    const router = useRouter()
    const formKey = ref(0)
    const password = ref(null)
    const password_confirmation = ref(null)
    const accountMenu = ref([
        {
            label: 'Profile',
            command: () => {
                router.push('/account/profile')
            },
        },
        {
            label: 'Password',
            command: () => {
                router.push('/account/password')
            },
        },
    ])

    const initialValues = reactive({
        name: '',
        email: '',
        phone: '',
    })

    const profileValidator = ({ values }) => {
        const errors = {}

        if (!values.name) {
            errors.name = [{ message: 'Name is required.' }]
        }

        if (!values.email) {
            errors.email = [{ message: 'Email is required.' }]
        } else if (!/\S+@\S+\.\S+/.test(values.email)) {
            errors.email = [{ message: 'Email is invalid.' }]
        }

        return { values, errors }
    }

    const changePasswordValidator = ({ values }) => {
        const errors = {}

        if (!values.current_password) {
            errors.current_password = [{ message: 'Current password is required.' }]
        }

        if (!values.password) {
            errors.password = [{ message: 'Password is required.' }]
        } else if (values.password.length < 8) {
            errors.password = [{ message: 'Password must be at least 8 characters long.' }]
        }

        if (!values.password_confirmation) {
            errors.password_confirmation = [{ message: 'Password again is required.' }]
        } else if (values.password.length < 8) {
            errors.password_confirmation = [
                { message: 'Password again must be at least 8 characters long.' },
            ]
        }

        if (values.password !== values.password_confirmation) {
            errors.password_confirmation = [
                { message: 'The password field confirmation does not match.' },
            ]
        }

        return { values, errors }
    }

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
        profileValidator,
        changePasswordValidator,
        initialValues,
        password,
        password_confirmation,
        formKey,
    }
}
