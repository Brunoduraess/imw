function menuShow() {
    const menu = document.getElementsByClassName('links')[0];
    const open = document.getElementsByClassName('open')[0];
    const close = document.getElementsByClassName('close')[0];

    menu.style.display = 'block';
    open.style.display = 'none';
    close.style.display = 'block';
}

function menuClose() {
    const menu = document.getElementsByClassName('links')[0];
    const open = document.getElementsByClassName('open')[0];
    const close = document.getElementsByClassName('close')[0];

    menu.style.display = 'none';
    open.style.display = 'block';
    close.style.display = 'none';
}