window.addEventListener('DOMContentLoaded', function () {

    if (window.location.pathname === '/register') { // comprobación de ubicación
        var contenedor = document.body;
        var form = document.getElementsByTagName('form')
        var btn = form[0].getElementsByTagName('button')

        contenedor.addEventListener('input', function (event) { // validación de datos
            var target = event.target;

            if (target.matches('input, select')) {
                console.log(form[0].validaOneByOne(event.target));

                var elementosDeEntrada = document.querySelectorAll('.inputs');

                var todosValidos = Array.from(elementosDeEntrada).every(function (elemento) {
                    return elemento.classList.contains('valido');
                });

                if (todosValidos) {
                    btn[0].removeAttribute('disabled')
                } else {
                    btn[0].setAttribute('disabled', 'true')
                }
            }
        })
    }
})