document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('openProfileImageModal');
    const closeModal = document.getElementById('closeProfileImageModal');
    const modal = document.getElementById('profileImageModal');

    openModal.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});