window.addEventListener('load', () => {
    const logout = document.querySelector('.settings');
    logout?.addEventListener('click', e => {
        e.preventDefault();
        localStorage.clear();
        window.location.href = '/settings';
    });
});