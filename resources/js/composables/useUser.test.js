import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useUser } from '@/composables/useUser'
import { fetchUsers, fetchUser, deleteUserById, toggleUserActive } from '@/services/userService'

const successMock = vi.fn()

vi.mock('vue-router', () => ({
    useRoute: () => ({
        params: {
            id: 123,
        },
    }),
}))

vi.mock('@/composables/useCustomToast', () => ({
    useCustomToast: () => ({
        customToast: {
            success: successMock,
        },
    }),
}))

vi.mock('@/services/userService', () => ({
    fetchUsers: vi.fn(),
    fetchUser: vi.fn(),
    deleteUserById: vi.fn(),
    toggleUserActive: vi.fn(),
}))

describe('useUser', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const user = useUser()

        expect(user.userId).toBe(123)

        expect(user.initialValues).toEqual({
            name: null,
            phone: '',
            email: null,
            active: true,
        })

        expect(user.users.value).toEqual([])
        expect(user.allUsers.value).toEqual([])
        expect(user.loading.value).toBe(false)
        expect(user.formKey.value).toBe(0)
    })

    it('loads users', async () => {
        vi.mocked(fetchUsers).mockResolvedValue({
            data: [
                { id: 1, name: 'John' },
                { id: 2, name: 'Jane' },
            ],
        })

        const user = useUser()

        await user.getUsers()

        expect(user.users.value).toHaveLength(2)
        expect(user.allUsers.value).toHaveLength(2)
        expect(user.loading.value).toBe(false)
    })

    it('loads user details', async () => {
        vi.mocked(fetchUser).mockResolvedValue({
            data: {
                name: 'John Doe',
                phone: '+36123456789',
                email: 'john@example.com',
                active: 1,
            },
        })

        const user = useUser()

        await user.getUser()

        expect(user.initialValues).toEqual({
            name: 'John Doe',
            phone: '+36123456789',
            email: 'john@example.com',
            active: true,
        })

        expect(user.formKey.value).toBe(1)
    })

    it('converts active flag to boolean', async () => {
        vi.mocked(fetchUser).mockResolvedValue({
            data: {
                name: 'John Doe',
                phone: '',
                email: 'john@example.com',
                active: 0,
            },
        })

        const user = useUser()

        await user.getUser()

        expect(user.initialValues.active).toBe(false)
    })

    it('toggles active status', async () => {
        vi.mocked(toggleUserActive).mockResolvedValue({
            data: {
                active: false,
            },
        })

        const user = useUser()

        user.users.value = [
            {
                id: 1,
                active: true,
            },
        ]

        await user.toggleActive(1)

        expect(toggleUserActive).toHaveBeenCalledWith(1)

        expect(user.users.value[0].active).toBe(false)
    })

    it('deletes user', async () => {
        vi.mocked(deleteUserById).mockResolvedValue({})

        const user = useUser()

        user.users.value = [
            { id: 1, name: 'John' },
            { id: 2, name: 'Jane' },
        ]

        await user.deleteUser(1)

        expect(deleteUserById).toHaveBeenCalledWith(1)

        expect(user.users.value).toEqual([{ id: 2, name: 'Jane' }])

        expect(successMock).toHaveBeenCalledWith('User deleted successfully!')
    })

    it('handles getUsers errors', async () => {
        vi.mocked(fetchUsers).mockRejectedValue(new Error())

        const user = useUser()

        await expect(user.getUsers()).resolves.toBeUndefined()

        expect(user.loading.value).toBe(false)
    })

    it('handles getUser errors', async () => {
        vi.mocked(fetchUser).mockRejectedValue(new Error())

        const user = useUser()

        await expect(user.getUser()).resolves.toBeUndefined()

        expect(user.loading.value).toBe(false)
    })

    it('handles toggleActive errors', async () => {
        vi.mocked(toggleUserActive).mockRejectedValue(new Error())

        const user = useUser()

        await expect(user.toggleActive(1)).resolves.toBeUndefined()
    })

    it('handles deleteUser errors', async () => {
        vi.mocked(deleteUserById).mockRejectedValue(new Error())

        const user = useUser()

        await expect(user.deleteUser(1)).resolves.toBeUndefined()

        expect(user.loading.value).toBe(false)
        expect(successMock).not.toHaveBeenCalled()
    })
})
