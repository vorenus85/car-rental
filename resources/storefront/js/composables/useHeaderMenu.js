export const useHeaderMenu = () => {
    const headerMenu = [
        { id: 1, title: 'Home', path: '/', name: 'home' },
        { id: 2, title: 'Fleet', path: '/fleet', name: 'fleet' },
        { id: 3, title: 'Services', path: '/services', name: 'services' },
        { id: 3, title: 'About us', path: '/about-us', name: 'about-us' },
        { id: 4, title: 'Contact', path: '/contact', name: 'contact' },
    ]

    return {
        headerMenu,
    }
}
