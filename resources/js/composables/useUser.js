import { useRoute } from 'vue-router'
import { fetchUsers, fetchUser, deleteUserById, toggleUserActive } from '@/services/userService'
import { useCustomToast } from '@/composables/useCustomToast'
import { reactive, ref } from 'vue'

export const useUser = () => {
    const loading = ref(false)
    const users = ref([])
    const allUsers = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const userId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: null,
        phone: '',
        email: null,
        active: true,
    })

    const userValidator = ({ values }) => {
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

    const toggleActive = async id => {
        //loading.value = true

        try {
            const { data } = await toggleUserActive(id)
            const userIndex = users.value.findIndex(el => el.id === id)
            users.value[userIndex].active = data.active
            //loading.value = false
        } catch (e) {
            //loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getUsers = async params => {
        loading.value = true

        try {
            const { data } = await fetchUsers({ ...params })
            allUsers.value = data
            users.value = data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getUser = async params => {
        loading.value = true

        try {
            const { data } = await fetchUser(userId, { ...params })
            initialValues.name = data.name
            initialValues.phone = data.phone
            initialValues.email = data.email
            initialValues.active = Boolean(data.active)
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteUser = async id => {
        loading.value = true

        try {
            await deleteUserById(id)
            const idIndex = users.value.findIndex(el => {
                return el.id === id
            })
            users.value.splice(idIndex, 1)

            customToast.success('User deleted successfully!')

            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    return {
        userValidator,
        toggleActive,
        loading,
        users,
        allUsers,
        getUsers,
        getUser,
        deleteUser,
        initialValues,
        formKey,
        userId,
    }
}
