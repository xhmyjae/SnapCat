const modals = document.querySelectorAll('.modal-post');
const btn = document.querySelectorAll('.post-profile-hover');
const closeBtn = document.querySelectorAll('.modal-close');
let profilePanel = document.querySelector('.profil-panel');

const keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
    e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

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


