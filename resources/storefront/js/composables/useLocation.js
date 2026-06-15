import { fetchLocations } from '@storefront/services/locationService'
import { ref, computed } from 'vue'

export const useLocation = () => {
    const loading = ref(false)
    const locations = ref([])

    const groupedLocations = computed(() => {
        const countries = {
            hu: 'Hungary',
            at: 'Austria',
            cz: 'Czech Republic',
        }

        return locations.value.reduce((groups, location) => {
            let group = groups.find(item => item.code === location.country)

            if (!group) {
                group = {
                    label: countries[location.country],
                    code: location.country,
                    items: [],
                }

                groups.push(group)
            }

            group.items.push({
                label: location.name,
                value: location.id,
            })

            return groups
        }, [])
    })

    const getLocations = async () => {
        loading.value = true

        try {
            const { data } = await fetchLocations()
            locations.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        locations,
        getLocations,
        groupedLocations,
    }
}
