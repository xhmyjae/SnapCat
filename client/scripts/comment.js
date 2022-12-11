// document.querySelector(".comment-button").addEventListener("click", () => {
//     document.querySelector(".comment-form").style.display = "block";
// });
// // When the user submits the comment form, send the comment to the server
// document.querySelector(".comment-form").addEventListener("submit", (event) => {
//     // Prevent the default form submission behavior
//     event.preventDefault();
//
//     // Get the comment and post ID from the form
//     const comment = document.querySelector("#comment-message").value;
//     const postId = document.querySelector("#post-id").value;
//     const userId = document.querySelector("#user-id").value;
//
//     // Send the comment to the server
//     fetch("/create_comment", {
//         method: "POST",
//         body: JSON.stringify({ comment, postId, userId }),
//     });
//
//     // Hide the form and clear the comment field
//     document.querySelector(".comment-form").style.display = "none";
//     document.querySelector("#comment-message").value = "";
// });
