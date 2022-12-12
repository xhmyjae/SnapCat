document.addEventListener('DOMContentLoaded', () => {
    const commentBtn = document.querySelectorAll('.comment-button');
    console.log(commentBtn);

    commentBtn.forEach(btn => {
        //display closest div with class comments
        btn.addEventListener('click', () => {
            const btnId = btn.classList[1];

            console.log(btnId);
            //comment div is a div with class comments & class of the id of the button
            const commentDiv = document.querySelectorAll(`.comments`);
            console.log(commentDiv);
            //display the comment div with the same id as the button
            commentDiv.forEach(div => {
                if (div.classList.contains(btnId)) {
                    div.classList.toggle('hidden');
                }
            })
        });
    });
});
