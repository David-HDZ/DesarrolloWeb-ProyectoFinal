(function(){
    
    const sliders = [...document.querySelectorAll('.comments__body')];
    const buttonNext = document.querySelector('#next');
    const buttonBefore = document.querySelector('#before');
    let value;   

    buttonNext.addEventListener('click', ()=>{
        changePosition(1);
    });

    buttonBefore.addEventListener('click', ()=>{
        changePosition(-1);
    });

    const changePosition = (add)=>{
        const currentcomments = document.querySelector('.comments__body--show').dataset.id;
        value = Number(currentcomments);
        value+= add;


        sliders[Number(currentcomments)-1].classList.remove('comments__body--show');
        if(value === sliders.length+1 || value === 0){
            value = value === 0 ? sliders.length  : 1;
        }

        sliders[value-1].classList.add('comments__body--show');

    }

})();