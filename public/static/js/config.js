document.addEventListener('DOMContentLoaded', () => {
    // Logout elements
    const logoutLink = document.getElementById('logout-link');
    const logoutForm = document.getElementById('logout-form');

    // Logout handler
    if (logoutLink && logoutForm) {
        logoutLink.addEventListener('click', (event) => {
            event.preventDefault();
            logoutForm.submit();
        });
    }

    // Modals initialization (only if elements exist)
    const addModalElement = document.getElementById('createDataModal');
    const editModalElement = document.getElementById('updateDataModal');
    
    const addModal = addModalElement ? new bootstrap.Modal(addModalElement) : null;
    const editModal = editModalElement ? new bootstrap.Modal(editModalElement) : null;

    // Livewire close handler
    window.addEventListener('closeModal', () => {
        addModal?.hide();
        editModal?.hide();
    });
});