window.addEventListener('load', () => {
    const logout = document.querySelector('.logout');
    logout?.addEventListener('click', e => {
        e.preventDefault();
        localStorage.clear();
        window.location.href = '/logout';
    });
});