window.addEventListener('load', () => {
    const settings = document.querySelector('.settings');
    settings?.addEventListener('click', e => {
        e.preventDefault();
        localStorage.clear();
        window.location.href = '/settings-page';
    });
});

