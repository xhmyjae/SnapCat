let textarea = document.querySelectorAll('.input-post');

textarea.forEach((el) => {
    el.addEventListener('keydown', () => {
        autosize(el);
    });
});

function autosize(el) {
    setTimeout(function () {
        el.style.cssText = 'height:auto; padding:0';
        el.style.cssText = 'height:' + el.scrollHeight + 'px';
    }, 0);
}