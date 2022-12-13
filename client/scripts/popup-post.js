const modals = document.querySelectorAll('.modal-post');
const btn = document.querySelectorAll('.post-profile-hover');
const closeBtn = document.querySelectorAll('.modal-close');
let profilePanel = document.querySelector('.profil-panel');


btn.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        let clicked = e.target;
        let modal = clicked.parentElement.querySelector('.modal-background');
        if (typeof modal.showModal === "function") {
            modal.showModal();
        }
    });
});

closeBtn.forEach((closeBtn) => {
    closeBtn.addEventListener('click', (e) => {
        let clicked = e.target;
        let modal = clicked.parentElement.parentElement.parentElement.parentElement;
        console.log(modal);
        modal.close();
    });
});
