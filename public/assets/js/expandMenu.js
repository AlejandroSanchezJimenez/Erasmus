document.addEventListener('DOMContentLoaded', function () {
    var menu = document.querySelector('.menu');
    var btnMenu = document.querySelector('.btn-menu');

    btnMenu.addEventListener('click', function () {
        // Cambia la anchura del menú a 150px
        menu.style.width = menu.style.width === '150px' ? '80px' : '150px';

        var homeText = document.createElement('div');
        homeText.width="0"
    });
});