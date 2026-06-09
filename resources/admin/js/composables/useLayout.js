import { onMounted, onUnmounted, ref } from 'vue'

export const useLayout = () => {
    const isMobile = ref(window.innerWidth <= 991)
    const darkTheme = ref(false)

    const updateIsMobile = () => {
        isMobile.value = window.innerWidth <= 991
    }

    const toggleDarkMode = () => {
        if (!document.startViewTransition) {
            executeDarkModeToggle()

            return
        }

        document.startViewTransition(() => executeDarkModeToggle())
    }

    const executeDarkModeToggle = () => {
        darkTheme.value = !darkTheme.value
        document.documentElement.classList.toggle('app-dark')
    }

    onMounted(() => {
        window.addEventListener('resize', updateIsMobile)
    })

    onUnmounted(() => {
        window.removeEventListener('resize', updateIsMobile)
    })

    return {
        isMobile,
        toggleDarkMode,
        darkTheme,
    }
}
