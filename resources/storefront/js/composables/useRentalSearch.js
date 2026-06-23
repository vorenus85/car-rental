import { ref, reactive } from 'vue'
import { useRoute } from 'vue-router'
export const useRentalSearch = () => {
    const route = useRoute()

    const defaultPickUpDate = new Date()
    const minPickUpDate = new Date()

    const defaultpickUpDate = ref(new Date())
    defaultpickUpDate.value.setHours(0, 0, 0, 0)

    const dropOffDate = new Date()
    dropOffDate.setDate(dropOffDate.getDate() + 3)

    const defaultDropOffDate = ref(dropOffDate)
    defaultDropOffDate.value.setHours(0, 0, 0, 0)

    const minDropOffDate = new Date()
    minDropOffDate.setDate(minDropOffDate.getDate() + 1)

    const createTimeOptions = (startHour, endHour, stepMinutes = 30) => {
        const options = []

        for (let hour = startHour; hour <= endHour; hour++) {
            for (let minute = 0; minute < 60; minute += stepMinutes) {
                if (hour === endHour && minute > 0) break

                const time = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`

                options.push({
                    label: time,
                    value: time,
                })
            }
        }

        return options
    }

    const timeOptions = createTimeOptions(10, 20)

    const hydrateRentalSearchFromQuery = () => {
        if (route.query.pickUpDate) {
            const pickUpDate = new Date(route.query.pickUpDate)
            pickUpDate.setHours(0, 0, 0, 0)
            searchParams.pickUpDate = pickUpDate
        }

        if (route.query.dropOffDate) {
            const dropOffDate = new Date(route.query.dropOffDate)
            dropOffDate.setHours(0, 0, 0, 0)
            searchParams.dropOffDate = dropOffDate
        }

        if (route.query.location) {
            searchParams.location = Number(route.query.location)
        }
    }

    const searchParams = reactive({
        location: null,
        pickUpDate: defaultPickUpDate,
        dropOffDate: defaultDropOffDate,
        pickUpTime: '10:00',
        dropOffTime: '20:00',
    })

    return {
        minPickUpDate,
        defaultPickUpDate,
        minDropOffDate,
        defaultDropOffDate,
        searchParams,
        hydrateRentalSearchFromQuery,
        timeOptions,
    }
}
