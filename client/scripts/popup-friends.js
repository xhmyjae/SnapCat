const friendsBtn = document.querySelector('.friends-popup-link');
const closeFriendsModalBtn = document.querySelector('.close-modal-friends');
let modal = document.querySelector('.modal-friends-dialog');

friendsBtn.addEventListener('click', () => {
    if (typeof modal.showModal === "function") {
        modal.showModal();
    }
});

closeFriendsModalBtn.addEventListener('click', () => {
    modal.close();
});
