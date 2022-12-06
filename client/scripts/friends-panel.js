let friendsButton = document.querySelector("#friends");
let requestButton = document.querySelector("#request");
let waitingButton = document.querySelector("#waiting");


window.addEventListener("load", () => {
    console.log("DOM fully loaded and parsed");
});
friendsButton.addEventListener("click", function (e) {
    console.log("friends");
    //display none waiting-container & request-container, display block friends-container
    let switchFriends1 = document.querySelector(".friends-container");
    let switchFriends2 = document.querySelector(".request-container");
    let switchFriends3 = document.querySelector(".waiting-container");
    switchFriends1.style.display = "block";
    switchFriends2.style.display = "none";
    switchFriends3.style.display = "none";

});
requestButton.addEventListener("click", function (e) {
        console.log("request");
        //display none friends-container & waiting-container, display block request-container
        let switchFriends1 = document.querySelector(".friends-container");
        let switchFriends2 = document.querySelector(".request-container");
        let switchFriends3 = document.querySelector(".waiting-container");
        switchFriends1.style.display = "none";
        switchFriends2.style.display = "block";
        switchFriends3.style.display = "none";
    }
);
waitingButton.addEventListener("click", function (e) {
        console.log("waiting");
        //display none friends-container & request-container, display block waiting-container
        let switchFriends1 = document.querySelector(".friends-container");
        let switchFriends2 = document.querySelector(".request-container");
        let switchFriends3 = document.querySelector(".waiting-container");
        switchFriends1.style.display = "none";
        switchFriends2.style.display = "none";
        switchFriends3.style.display = "block";
    }
);


