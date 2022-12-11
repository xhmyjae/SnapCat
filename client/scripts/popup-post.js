const modals = document.querySelectorAll('.modal-post');
const btn = document.querySelectorAll('.post-profile-hover');
const closeBtn = document.querySelectorAll('.modal-close');
console.log(closeBtn);

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

// Make modal appear by adding modal-display class on btn click
btn.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        let clicked = e.target;
        let modal = clicked.parentElement.lastElementChild;
        modal.classList.add('modal-display');
    });
});

closeBtn.forEach((closeBtn) => {
    closeBtn.addEventListener('click', (e) => {
        let clicked = e.target;
        let modal = clicked.parentElement.parentElement.parentElement;
        console.log(modal);
        modal.classList.remove('modal-display');
    });
});