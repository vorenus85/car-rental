import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useCustomer } from '@admin/composables/useCustomer'
import {
    fetchCustomers,
    fetchCustomer,
    deleteCustomerById,
    toggleCustomerActive,
    sendPasswordReset,
} from '@admin/services/customerService'

const successMock = vi.fn()
const errorMock = vi.fn()

vi.mock('vue-router', () => ({
    useRoute: () => ({
        params: {
            id: 123,
        },
    }),
}))

vi.mock('@admin/composables/useCustomToast', () => ({
    useCustomToast: () => ({
        customToast: {
            success: successMock,
            error: errorMock,
        },
    }),
}))

vi.mock('@admin/services/customerService', () => ({
    fetchCustomers: vi.fn(),
    fetchCustomer: vi.fn(),
    deleteCustomerById: vi.fn(),
    toggleCustomerActive: vi.fn(),
    sendPasswordReset: vi.fn(),
}))

describe('useCustomer', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const customer = useCustomer()

        expect(customer.customerId).toBe(123)
        expect(customer.initialValues).toEqual({
            firstName: null,
            lastName: null,
            phone: '',
            email: null,
            active: true,
        })
        expect(customer.customers.value).toEqual([])
        expect(customer.allCustomers.value).toEqual([])
        expect(customer.loading.value).toBe(false)
        expect(customer.formKey.value).toBe(0)
    })

    it('loads customers', async () => {
        const customersData = [
            { id: 1, firstName: 'John', lastName: 'Doe', active: true },
            { id: 2, firstName: 'Jane', lastName: 'Doe', active: false },
        ]

        vi.mocked(fetchCustomers).mockResolvedValue({
            data: customersData,
        })

        const customer = useCustomer()

        await customer.getCustomers({
            page: 1,
            search: 'doe',
        })

        expect(fetchCustomers).toHaveBeenCalledWith({
            page: 1,
            search: 'doe',
        })
        expect(customer.allCustomers.value).toEqual(customersData)
        expect(customer.customers.value).toEqual(customersData)
        expect(customer.loading.value).toBe(false)
    })

    it('loads customer details', async () => {
        vi.mocked(fetchCustomer).mockResolvedValue({
            data: {
                firstName: 'John',
                lastName: 'Doe',
                phone: '+36123456789',
                email: 'john@example.com',
                active: 1,
            },
        })

        const customer = useCustomer()

        await customer.getCustomer({
            include: 'bookings',
        })

        expect(fetchCustomer).toHaveBeenCalledWith(123, {
            include: 'bookings',
        })
        expect(customer.initialValues).toEqual({
            firstName: 'John',
            lastName: 'Doe',
            phone: '+36123456789',
            email: 'john@example.com',
            active: true,
        })
        expect(customer.formKey.value).toBe(1)
        expect(customer.loading.value).toBe(false)
    })

    it('converts active flag to boolean', async () => {
        vi.mocked(fetchCustomer).mockResolvedValue({
            data: {
                firstName: 'John',
                lastName: 'Doe',
                phone: '',
                email: 'john@example.com',
                active: 0,
            },
        })

        const customer = useCustomer()

        await customer.getCustomer()

        expect(customer.initialValues.active).toBe(false)
    })

    it('toggles active status', async () => {
        vi.mocked(toggleCustomerActive).mockResolvedValue({
            data: {
                active: false,
            },
        })

        const customer = useCustomer()

        customer.customers.value = [
            { id: 1, active: true },
            { id: 2, active: true },
        ]

        await customer.toggleActive(2)

        expect(toggleCustomerActive).toHaveBeenCalledWith(2)
        expect(customer.customers.value[1].active).toBe(false)
    })

    it('deletes customer', async () => {
        vi.mocked(deleteCustomerById).mockResolvedValue({})

        const customer = useCustomer()

        customer.customers.value = [
            { id: 1, firstName: 'John', lastName: 'Doe' },
            { id: 2, firstName: 'Jane', lastName: 'Doe' },
        ]

        await customer.deleteCustomer(1)

        expect(deleteCustomerById).toHaveBeenCalledWith(1)
        expect(customer.customers.value).toEqual([{ id: 2, firstName: 'Jane', lastName: 'Doe' }])
        expect(successMock).toHaveBeenCalledWith('Customer deleted successfully!')
    })

    it('sends password reset email', async () => {
        vi.mocked(sendPasswordReset).mockResolvedValue({
            data: {
                message: 'Reset email sent',
            },
        })

        const customer = useCustomer()

        await customer.doSendPasswordReset(5)

        expect(sendPasswordReset).toHaveBeenCalledWith(5)
        expect(successMock).toHaveBeenCalledWith('Reset email sent')
    })

    it('shows default error when password reset fails without message', async () => {
        vi.mocked(sendPasswordReset).mockRejectedValue(new Error('API error'))

        const customer = useCustomer()

        await customer.doSendPasswordReset(5)

        expect(errorMock).toHaveBeenCalledWith('Please try again.')
    })

    it('shows backend error message when password reset fails with message', async () => {
        vi.mocked(sendPasswordReset).mockRejectedValue({
            response: {
                data: {
                    message: 'Too many requests',
                },
            },
        })

        const customer = useCustomer()

        await customer.doSendPasswordReset(5)

        expect(errorMock).toHaveBeenCalledWith('Too many requests')
    })

    it('handles getCustomers errors', async () => {
        vi.mocked(fetchCustomers).mockRejectedValue(new Error('API Error'))

        const customer = useCustomer()

        await expect(customer.getCustomers()).resolves.toBeUndefined()

        expect(customer.loading.value).toBe(false)
    })

    it('handles getCustomer errors', async () => {
        vi.mocked(fetchCustomer).mockRejectedValue(new Error('API Error'))

        const customer = useCustomer()

        await expect(customer.getCustomer()).resolves.toBeUndefined()

        expect(customer.loading.value).toBe(false)
    })

    it('handles deleteCustomer errors', async () => {
        vi.mocked(deleteCustomerById).mockRejectedValue(new Error('API Error'))

        const customer = useCustomer()

        await expect(customer.deleteCustomer(1)).resolves.toBeUndefined()

        expect(customer.loading.value).toBe(false)
        expect(successMock).not.toHaveBeenCalled()
    })
})
