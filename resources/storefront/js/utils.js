export const formatDate = date => {
    const year = date.getFullYear()
    const month = String(date.getMonth() + 1).padStart(2, '0')
    const day = String(date.getDate()).padStart(2, '0')

    return `${year}-${month}-${day}`
}

export const formatTime = date => {
    const hours = String(date.getHours()).padStart(2, '0')
    const minutes = String(date.getMinutes()).padStart(2, '0')

    return `${hours}:${minutes}`
}

export const getDaysBetween = (start, end) => {
    const startDate = new Date(start)
    startDate.setHours(0, 0, 0, 0)
    const endDate = new Date(end)
    endDate.setHours(0, 0, 0, 0)

    const diffTime = endDate.getTime() - startDate.getTime()

    return Math.ceil(diffTime / (1000 * 60 * 60 * 24))
}
