window.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname === '/proyectos') {
        var inputs = document.querySelectorAll('input, select')
        var form = document.getElementsByTagName('form')
        var butt = document.getElementById('enviar')

        inputs.forEach(function (inputElement) {
            inputElement.addEventListener('input', function (event) {
                form[0].validaOneByOne(inputElement);

                var elementosDeEntrada = document.querySelectorAll('.active input, .active select');

                var todosValidos = Array.from(elementosDeEntrada).every(function (elemento) {
                    return elemento.classList.contains('valido');
                });

                if (todosValidos) {
                    butt.removeAttribute('disabled')
                } else {
                    butt.setAttribute('disabled', 'true')
                }
            });
        });
    }
})