export const useCustomConfirm = () => {
    const confirmAction = (
        confirm,
        {
            action,
            message = 'Do you want to delete this record?',
            header = 'Danger Zone',
            icon = 'pi pi-info-circle',
            acceptLabel = 'OK',
            rejectLabel = 'Cancel',
        }
    ) => {
        confirm.require({
            message,
            header,
            icon,
            rejectLabel,
            rejectProps: { label: rejectLabel, severity: 'secondary', outlined: true },
            acceptProps: { label: acceptLabel, severity: 'danger' },
            accept: () => action(),
            reject: () => {},
        })
    }

    return { confirmAction }
}
