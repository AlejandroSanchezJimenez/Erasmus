window.addEventListener('DOMContentLoaded', function () {

    var inputs = document.querySelectorAll('input, select')
    var form = document.getElementsByTagName('form')

    fetch("https://localhost:8000/destinatario/api") // relleno el select con categorias
        .then(x => x.json())
        .then(y => {
            for (let i = 0; i < y.length; i++) {
                var container = document.getElementById('des-container');

                var label = document.createElement('label')
                label.className = "form-control"
                label.textContent = y[i].cod

                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = "checkbox" + (i + 1);
                checkbox.value = y[i].cod;

                label.appendChild(checkbox)
                container.appendChild(label)
            }
        });

    inputs.forEach(function (inputElement) {
        inputElement.addEventListener('input', function (event) {
            form[0].validaOneByOne(inputElement);

            var elementosDeEntrada = document.querySelectorAll('.active input, .active select');

            if (document.querySelector('.tab-content.active').id == 'content3') {
                var btnidioma = document.getElementById('chkIdioma')
                var fila = btnidioma.closest('tr');
                elementosDeEntrada = fila.querySelectorAll('select, input');

                var idiomas = document.querySelectorAll('.sec4')
                idiomas.forEach(element => {
                    element.max = elementosDeEntrada[1].value
                });
            }

            var todosValidos = Array.from(elementosDeEntrada).every(function (elemento) {
                return elemento.classList.contains('valido');
            });

            if (todosValidos) {
                if (document.querySelector('.tab-content.active').id == 'content1') {
                    document.querySelector('button.active').nextElementSibling.removeAttribute('disabled')
                } else if (document.querySelector('.tab-content.active').id == 'content3') {
                    document.querySelector('button.active').nextElementSibling.removeAttribute('disabled')
                } else if (document.querySelector('.tab-content.active').id == 'content4') {
                    var buttons = document.querySelectorAll('.enviar')
                    buttons.forEach(element => {
                        element.removeAttribute('disabled');
                    });
                }
            } else {
                if (document.querySelector('button.active').nextElementSibling !== null && !document.querySelector('button.active').nextElementSibling.hasAttribute('disabled')) {
                    document.querySelector('button.active').nextElementSibling.setAttribute('disabled', 'true')
                }
            }
        });
    });

    var sections = document.querySelectorAll('.tab-button');

    sections.forEach(element => {
        element.addEventListener('click', function (ev) {
            ev.preventDefault()
            var actives = document.querySelectorAll('.active');
            var content = document.getElementById('content' + element.id);

            actives.forEach(activeElement => {
                activeElement.classList.remove("active");
            });

            element.classList.add('active');

            content.classList.add('active'); // Remove 'active' class from content
        });
    });

    var checkboxes = document.querySelectorAll('table td input.checkbox-input');

    // Agregar un event listener a cada checkbox
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('click', function () {
            // Obtener la fila actual del checkbox
            var fila = this.closest('tr');

            // Obtener todos los selects e inputs en la fila
            var selectsEInputs = fila.querySelectorAll('select, input');

            // Iterar sobre los selects e inputs y quitar el atributo 'disabled'
            selectsEInputs.forEach(function (elemento) {
                if (elemento.hasAttribute('disabled')) {
                    elemento.removeAttribute('disabled');
                } else {
                    elemento.setAttribute('disabled', 'disabled');
                    elemento.classList.remove("valido", "invalido");
                    checkbox.removeAttribute('disabled');
                }
            });
        });
    });

    var butt2 = document.getElementById('2')

    butt2.addEventListener('click', function () {
        if (document.querySelectorAll('.active#content2').length > 0) {

            var checks = document.querySelectorAll('.active input[type=checkbox]');

            checks.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    if (document.querySelectorAll('.active input[type=checkbox]:checked').length >= 1) {
                        document.querySelector('button.active').nextElementSibling.removeAttribute('disabled')
                    } else {
                        if (!document.querySelector('button.active').nextElementSibling.hasAttribute('disabled')) {
                            document.querySelector('button.active').nextElementSibling.setAttribute('disabled', 'true')
                        }
                    }
                });
            });
        }
    })

    // var btnidioma = document.getElementById('chkIdioma')

    // btnidioma.addEventListener('change', function () {
    //     if (btnidioma.checked == true) {
    //         var fila = this.closest('tr');

    //         var selectsEInputs = fila.querySelectorAll('select, input');

    //         var todosValidos = Array.from(selectsEInputs).every(function (elemento) {
    //             return elemento.classList.contains('valido');
    //         });

    //         if (todosValidos) {
    //             document.querySelector('button.active').nextElementSibling.removeAttribute('disabled')
    //         }
    //     } else {
    //         document.querySelector('button.active').nextElementSibling.setAttribute('disabled', 'true')
    //     }
    // })
});