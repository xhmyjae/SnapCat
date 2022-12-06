window.addEventListener('load', () => {
    const settings = document.querySelector('.profile-link');
    settings?.addEventListener('click', e => {
        e.preventDefault();
        localStorage.clear();
        window.location.href = '/profile';
    });
});

