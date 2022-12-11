const modals = document.querySelectorAll('.modal-post');
const btn = document.querySelectorAll('.post-profile');
console.log(modals);
console.log(btn);

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
    btn.addEventListener('click', () => {
        console.log('clicked');
        let modal = btn.lastElementChild;
        console.log(modal);
        modal.classList.add('modal-display');
        // modals.forEach((modal) => {
        //
        //     modal.classList.add('modal-display');
        // });
    });
});

// Make modal disappear by removing modal-display class when user clicks outside of modal
window.addEventListener('click', (e) => {
    modals.forEach((modal) => {
        if (e.target === modal) {
            modal.classList.remove('modal-display');
        }
    });
});
