let friendsButton = document.querySelector("#friends");
let requestButton = document.querySelector("#request");
let waitingButton = document.querySelector("#waiting");
let searchButton = document.querySelector("#search");
let acceptButton = document.querySelector(".fa-check");
let deniedButton = document.querySelector(".fa-xmark");


friendsButton.addEventListener("click", function (e) {
    let switchFriends1 = document.querySelector(".friends-container");
    let switchFriends2 = document.querySelector(".request-container");
    let switchFriends3 = document.querySelector(".waiting-container");
    let switchFriends4 = document.querySelector(".search-container");
    switchFriends1.style.display = "block";
    switchFriends2.style.display = "none";
    switchFriends3.style.display = "none";
    switchFriends4.style.display = "none";

});
requestButton.addEventListener("click", function (e) {
        let switchFriends1 = document.querySelector(".friends-container");
        let switchFriends2 = document.querySelector(".request-container");
        let switchFriends3 = document.querySelector(".waiting-container");
        let switchFriends4 = document.querySelector(".search-container");
        switchFriends1.style.display = "none";
        switchFriends2.style.display = "block";
        switchFriends3.style.display = "none";
        switchFriends4.style.display = "none";
    }
);
waitingButton.addEventListener("click", function (e) {
        let switchFriends1 = document.querySelector(".friends-container");
        let switchFriends2 = document.querySelector(".request-container");
        let switchFriends3 = document.querySelector(".waiting-container");
        let switchFriends4 = document.querySelector(".search-container");
        switchFriends1.style.display = "none";
        switchFriends2.style.display = "none";
        switchFriends3.style.display = "block";
        switchFriends4.style.display = "none";
    }
);

searchButton.addEventListener("click", function (e) {
        let switchFriends1 = document.querySelector(".friends-container");
        let switchFriends2 = document.querySelector(".request-container");
        let switchFriends3 = document.querySelector(".waiting-container");
        let switchFriends4 = document.querySelector(".search-container");
        switchFriends1.style.display = "none";
        switchFriends2.style.display = "none";
        switchFriends3.style.display = "none";
        switchFriends4.style.display = "block";
    }
);
acceptButton.addEventListener("click", function (e) {
    let accept = document.querySelector(".request-container .friend");
    let friendsContainer = document.querySelector(".friends-container");
    friendsContainer.appendChild(accept);
    acceptButton.style.display = "none";
    deniedButton.style.display = "none";
}
);

deniedButton.addEventListener("click", function (e) {
    let denied = document.querySelector(".request-container .friend");
    denied.style.display = "none";
}
);