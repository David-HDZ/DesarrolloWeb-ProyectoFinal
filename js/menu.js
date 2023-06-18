(function(){
    const openButton = document.querySelector('.navbar__menu');
    const menu = document.querySelector('.navbar__link__principal');
    const closeMenu = document.querySelector('.navbar__close');

    openButton.addEventListener('click', ()=>{
        menu.classList.add('navbar__link--show');
    });

    closeMenu.addEventListener('click', ()=>{
        menu.classList.remove('navbar__link--show');
    });

    


})();