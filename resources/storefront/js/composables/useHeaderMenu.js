export const useHeaderMenu = () => {
    const headerMenu = [
        { id: 1, title: 'Home', path: '/' },
        { id: 2, title: 'Cars', path: '/cars' },
        { id: 3, title: 'Services', path: '/services' },
        { id: 3, title: 'About us', path: '/about-us' },
        { id: 4, title: 'Contact', path: '/contact' },
    ]

    return {
        headerMenu,
    }
}
