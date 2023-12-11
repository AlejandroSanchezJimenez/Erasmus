window.addEventListener('DOMContentLoaded', function () {

    if (window.location.pathname === '/convocatorias/new') {
        var inputs = document.querySelectorAll('input, select')
        var form = document.getElementsByTagName('form')
        var contenedor = document.body;

        fetch("https://localhost:8000/proyectos/api")
            .then(x => x.json())
            .then(y => {
                var select = document.getElementById('id_proyecto');

                // Limpiar opciones existentes, si es necesario
                select.innerHTML = '';

                var option = document.createElement("option");
                option.innerHTML = 'Sin seleccionar';
                option.value = '';
                select.appendChild(option);


                // Agregar opciones al select después del bucle
                for (let i = 0; i < y.length; i++) {
                    var option = document.createElement("option");
                    option.innerHTML = y[i].nombre;
                    option.value = y[i].id;
                    select.appendChild(option);
                }
            });

        fetch("https://localhost:8000/destinatario/api")
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
                    checkbox.value = y[i].id;
                    checkbox.className = 'destinatarios'

                    label.appendChild(checkbox)
                    container.appendChild(label)
                }
            });

        fetch("https://localhost:8000/nivelidiomas/api")
            .then(x => x.json())
            .then(y => {
                var tabla = document.getElementById('idiomas');
                var thead = tabla.querySelector('thead')
                var tbody = tabla.querySelector('tbody')
                var nuevaFila = document.createElement('tr');
                var nuevaFilaBody = document.createElement('tr');

                for (let i = 0; i < y.length; i++) {
                    var th = document.createElement('th');
                    th.textContent = y[i].nombre
                    nuevaFila.appendChild(th)

                    var td = document.createElement('td')
                    var input = document.createElement('input')
                    input.type = 'number'
                    input.step = '0.1'
                    input.placeholder = y[i].nombre
                    input.setAttribute('data-valida', 'double');
                    input.className = 'sec4'
                    input.id = y[i].id
                    td.appendChild(input)
                    nuevaFilaBody.appendChild(td)
                }

                thead.appendChild(nuevaFila)
                tbody.appendChild(nuevaFilaBody)
            });

        fetch("https://localhost:8000/itembaremable/api") // relleno el select con categorias
            .then(response => response.json())
            .then(item => {
                var tabla = document.getElementById('baremos');
                var tbody = tabla.querySelector('tbody')

                for (let i = 0; i < item.length; i++) {
                    const newRow = document.createElement('tr');
                    newRow.className = 'tr'

                    // Crear el primer celda con un div interno
                    const cell1 = document.createElement('td');
                    const checkboxContainer = document.createElement('div');
                    const checkbox = document.createElement('input');
                    const checkboxLabel = document.createElement('label');
                    const checkboxLabelText = document.createElement('span');

                    checkbox.type = 'checkbox';
                    checkbox.className = 'checkbox-custom checkbox-input sec3 ' + item[i].nombre;
                    checkbox.id = 'chk' + item[i].nombre;
                    checkbox.setAttribute('data-valida', 'chkbox');
                    checkbox.value = item[i].id

                    checkboxLabel.htmlFor = 'chkNota';
                    checkboxLabelText.textContent = item[i].nombre;

                    checkboxContainer.className = 'checkbox-container'
                    checkboxContainer.appendChild(checkbox);
                    checkboxContainer.appendChild(checkboxLabel);
                    checkboxContainer.appendChild(checkboxLabelText);
                    cell1.appendChild(checkboxContainer);

                    // Crear el resto de las celdas
                    const cell2 = document.createElement('td');
                    const maxNotaInput = document.createElement('input');
                    maxNotaInput.type = 'number';
                    maxNotaInput.placeholder = 'Máximo de ' + item[i].nombre;
                    maxNotaInput.setAttribute('data-valida', 'double');
                    maxNotaInput.disabled = true;
                    maxNotaInput.className = 'max'
                    maxNotaInput.min = 0.1
                    cell2.appendChild(maxNotaInput);

                    const cell3 = document.createElement('td');
                    const maxSelect = document.createElement('select');
                    maxSelect.disabled = true;
                    maxSelect.setAttribute('data-valida', 'select');
                    maxSelect.className = 'requisito'
                    maxSelect.id = 'max' + item[i].nombre

                    const maxOption1 = document.createElement('option');
                    maxOption1.value = '';
                    maxOption1.textContent = 'Sin seleccionar';

                    const maxOption2 = document.createElement('option');
                    maxOption2.value = true;
                    maxOption2.textContent = 'Sí';

                    const maxOption3 = document.createElement('option');
                    maxOption3.value = false;
                    maxOption3.textContent = 'No';

                    maxSelect.appendChild(maxOption1);
                    maxSelect.appendChild(maxOption2);
                    maxSelect.appendChild(maxOption3);
                    cell3.appendChild(maxSelect);

                    const cell4 = document.createElement('td');
                    const minNotaInput = document.createElement('input');
                    minNotaInput.type = 'number';
                    minNotaInput.placeholder = 'Mínimo de ' + item[i].nombre;
                    minNotaInput.setAttribute('data-valida', 'double');
                    minNotaInput.disabled = true;
                    minNotaInput.className = item[i].nombre
                    minNotaInput.min = 0.1
                    cell4.appendChild(minNotaInput);

                    const cell5 = document.createElement('td');
                    const minSelect = document.createElement('select');
                    minSelect.disabled = true;
                    minSelect.setAttribute('data-valida', 'select');
                    minSelect.className = 'aporta'

                    const minOption1 = document.createElement('option');
                    minOption1.value = '';
                    minOption1.textContent = 'Sin seleccionar';

                    const minOption2 = document.createElement('option');
                    minOption2.value = true;
                    minOption2.textContent = 'Sí';

                    const minOption3 = document.createElement('option');
                    minOption3.value = false;
                    minOption3.textContent = 'No';

                    minSelect.appendChild(minOption1);
                    minSelect.appendChild(minOption2);
                    minSelect.appendChild(minOption3);
                    cell5.appendChild(minSelect);

                    // Agregar las celdas a la fila
                    newRow.appendChild(cell1);
                    newRow.appendChild(cell2);
                    newRow.appendChild(cell3);
                    newRow.appendChild(cell4);
                    newRow.appendChild(cell5);

                    tbody.appendChild(newRow)
                }
            })
            .catch(error => console.error('Error al cargar datos:', error));

        var fechas = document.querySelectorAll('.date')

        fechas.forEach(element => {
            element.addEventListener('change', function (ev) {
                console.log()
                switch (element.id) {
                    case 'fechaInicio':
                        document.getElementById('fechaFin').min = element.value
                        document.getElementById('fechaPruebasInicio').max = element.value
                        document.getElementById('fechaPruebasFin').max = element.value
                        document.getElementById('fechaListadoProvisional').max = element.value
                        document.getElementById('fechaListadoOficial').max = element.value

                        if (document.getElementById('fechaInicio').value != '' && document.getElementById('fechaFin').value != '') {
                            var fechaInicio = new Date(document.getElementById('fechaInicio').value).getTime();

                            var fechaFin = new Date(document.getElementById('fechaFin').value).getTime();

                            var diff = fechaFin - fechaInicio

                            var diffDias = diff / (1000 * 60 * 60 * 24);

                            document.getElementById('tiempo').value = parseInt(diffDias);
                            document.getElementById('tiempo').classList.add("valido");

                            if (diffDias < 30) {
                                document.getElementById('tipo').value = 'Corto';
                                document.getElementById('tipo').classList.add("valido");
                            } else {
                                document.getElementById('tipo').value = 'Largo';
                                document.getElementById('tipo').classList.add("valido");
                            }
                        }
                        break;

                    case 'fechaFin':
                        document.getElementById('fechaInicio').max = element.value
                        if (document.getElementById('fechaInicio').value != '' && document.getElementById('fechaFin').value != '') {
                            var fechaInicio = new Date(document.getElementById('fechaInicio').value).getTime();

                            var fechaFin = new Date(document.getElementById('fechaFin').value).getTime();

                            var diff = fechaFin - fechaInicio

                            var diffDias = diff / (1000 * 60 * 60 * 24);

                            document.getElementById('tiempo').value = parseInt(diffDias);
                            document.getElementById('tiempo').classList.add("valido");

                            if (diffDias < 30) {
                                document.getElementById('tipo').value = 'Corto';
                                document.getElementById('tipo').classList.add("valido");
                            } else {
                                document.getElementById('tipo').value = 'Largo';
                                document.getElementById('tipo').classList.add("valido");
                            }
                        }
                        break;
                    case 'fechaPruebasInicio':
                        document.getElementById('fechaPruebasFin').min = element.value
                        break;
                    case 'fechaPruebasFin':
                        document.getElementById('fechaPruebasInicio').max = element.value
                        document.getElementById('fechaListadoProvisional').min = element.value
                        break;
                    case 'fechaListadoProvisional':
                        document.getElementById('fechaListadoOficial').min = element.value
                        break;
                    case 'fechaListadoOficial':
                        document.getElementById('fechaListadoProvisional').max = element.value
                        break;
                }
            })
        });

        // inputs.forEach(function (inputElement) {
        contenedor.addEventListener('input', function (event) {
            var target = event.target;
            console.log(target.className)

            // Verifica si el elemento clicado es un input con la clase 'checkbox-input'
            if (target.matches('input, select')) {
                form[0].validaOneByOne(event.target);

                var elementosDeEntrada = document.querySelectorAll('.active input, .active select');

                if (document.querySelector('.tab-content.active').id == 'content3') {
                    var fila = target.closest('tr');
                    elementosDeEntrada = fila.querySelectorAll('select, input');
                    if (target.id == 'maxIdioma') {
                        var idiomas = document.querySelectorAll('.sec4')
                        idiomas.forEach(element => {
                            element.max = elementosDeEntrada[1].value
                        });
                    } else if (target.classList.contains('requisito')) {
                        if (target.value == 'false') {
                            elementosDeEntrada[3].value = 0
                            elementosDeEntrada[3].readOnly = true;
                        } else {
                            elementosDeEntrada[3].readOnly = false;
                        }
                    } else if (target.classList.contains('max')) {
                        elementosDeEntrada[3].max = elementosDeEntrada[1].value
                    }
                }

                var todosValidos = Array.from(elementosDeEntrada).every(function (elemento) {
                    return elemento.classList.contains('valido');
                });

                if (todosValidos) {
                    if (document.querySelector('.tab-content.active').id == 'content1' || document.querySelector('.tab-content.active').id == 'content2') {
                        document.querySelector('button.active').nextElementSibling.removeAttribute('disabled')
                    } else if (document.querySelector('.tab-content.active').id == 'content3') {
                        var fila = target.closest('tr');
                        var inputsfila = fila.getElementsByTagName('input')
                        if (inputsfila[0].classList.contains('Idioma')) {
                            document.querySelector('button.active').nextElementSibling.removeAttribute('disabled')
                        } else {
                            var buttons = document.querySelectorAll('.enviar')
                            buttons.forEach(element => {
                                element.removeAttribute('disabled');
                            });
                        }

                    } else if (document.querySelector('.tab-content.active').id == 'content4') {
                        var buttons = document.querySelectorAll('.enviar')
                        buttons.forEach(element => {
                            element.removeAttribute('disabled');
                        });
                    }
                } else {
                    if (document.querySelector('button.active').nextElementSibling !== null && !document.querySelector('button.active').nextElementSibling.hasAttribute('disabled') && !document.querySelector('.tab-content.active').id == 'content3') {
                        document.querySelector('button.active').nextElementSibling.setAttribute('disabled', 'true')
                    } else if (document.querySelector('.tab-content.active').id == 'content3') {
                        var fila = target.closest('tr');
                        elementosDeEntrada = fila.querySelectorAll('select, input');
                        if (elementosDeEntrada[0].id = 'chkIdioma') {
                            document.querySelector('button.active').nextElementSibling.setAttribute('disabled', 'true')
                            var buttons = document.querySelectorAll('.enviar')
                            buttons.forEach(element => {
                                element.removeAttribute('disabled');
                            });
                        }
                        var buttons = document.querySelectorAll('.enviar')
                        buttons.forEach(element => {
                            element.setAttribute('disabled', 'true');
                        });
                    }

                    // if (document.querySelector('.tab-content.active').id == 'content3') {
                    //     // Obtener la referencia a la tabla
                    //     var tabla = document.getElementById('baremos');

                    //     // Obtener todas las filas dentro del tbody
                    //     var filas = tabla.getElementsByClassName('tr');
                    //     var filaactiva = false
                    //     // Iterar sobre cada fila
                    //     for (var i = 0; i < filas.length; i++) {
                    //         var fila = filas[i];

                    //         // Obtener todas las celdas de la fila
                    //         var inputs = fila.querySelectorAll('select, input');

                    //         // Iterar sobre cada celda de la fila
                    //         var todosValidos = Array.from(inputs).every(function (elemento) {
                    //             return elemento.classList.contains('valido');
                    //         });

                    //         // Hacer algo con el resultado de la verificación
                    //         if (todosValidos) {
                    //             filaactiva = true
                    //             break
                    //         } else {
                    //             filaactiva = false
                    //         }
                    //     }

                    //     if (!filaactiva) {
                    //         var buttons = document.querySelectorAll('.enviar')
                    //         buttons.forEach(element => {
                    //             element.setAttribute('disabled','true');
                    //         });
                    //     }


                    // }
                }
            }
        });
        // });

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

        setTimeout(() => {
            var checkboxes = document.querySelectorAll('table td input.checkbox-input');

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('click', function () {
                    var fila = this.closest('tr');

                    // Obtener todos los selects e inputs en la fila
                    var selectsEInputs = fila.querySelectorAll('select, input');

                    // Iterar sobre los selects e inputs y cambiar el atributo 'disabled'
                    selectsEInputs.forEach(function (elemento) {
                        if (checkbox.checked) {
                            elemento.removeAttribute('disabled');
                        } else {
                            elemento.setAttribute('disabled', 'disabled');
                            elemento.classList.remove("valido", "invalido");
                            elemento.value = ''
                            elemento.selectedIndex = 0
                            checkbox.removeAttribute('disabled');
                        }
                    });
                });
            });
        }, 5000);


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

        var buttons = document.querySelectorAll('.enviar')

        buttons.forEach(element => {
            element.addEventListener('click', function (ev) {
                ev.preventDefault()

                // CONVOCATORIA 
                var comboCorr = document.getElementById('id_proyecto');
                var selectedCorr = comboCorr.options[comboCorr.selectedIndex].value;

                var checkboxesMarcados = document.querySelectorAll('input[type="checkbox"].destinatarios:checked');
                var valoresCheckboxDes = [];

                // Iterar sobre los elementos checkbox marcados y leer sus valores
                checkboxesMarcados.forEach(function (checkbox) {
                    var valorCheckbox = checkbox.value;
                    valoresCheckboxDes.push(valorCheckbox);
                });

                checkboxesMarcados = document.querySelectorAll('input[type="checkbox"].sec3:checked');
                var valoresCheckboxBar = [];

                class ConvocatoriaBaremables {
                    constructor(idBaremo, Maximo, Requisito, Minimo, Aporta) {
                        this.idBaremo = idBaremo;
                        this.Maximo = Maximo;
                        this.Requisito = Requisito;
                        this.Minimo = Minimo;
                        this.Aporta = Aporta;
                    }
                }

                checkboxesMarcados.forEach(function (checkbox) {
                    var fila = checkbox.closest('tr');
                    elementosDeEntrada = fila.querySelectorAll('select, input');

                    var baremoConvo = new ConvocatoriaBaremables(elementosDeEntrada[0].value, elementosDeEntrada[1].value, elementosDeEntrada[2].value, elementosDeEntrada[3].value, elementosDeEntrada[4].value)

                    valoresCheckboxBar.push(baremoConvo)
                });

                var checkboxesMarcados = document.querySelectorAll('input.sec4');
                var valoresCheckboxIdi = [];

                // Iterar sobre los elementos checkbox marcados y leer sus valores
                checkboxesMarcados.forEach(function (checkbox) {
                    var valorCheckbox = checkbox.value;
                    var idCheckbox = checkbox.id;
                    valoresCheckboxIdi.push({
                        valor: valorCheckbox,
                        id: idCheckbox
                    });
                });

                const postConvocatoriaData = {
                    idProyecto: selectedCorr,
                    nombre: document.getElementById('nombre').value,
                    movilidades: document.getElementById('movilidades').value,
                    fechaInicio: document.getElementById('fechaInicio').value,
                    fechaFin: document.getElementById('fechaFin').value,
                    fechaPruebasInicio: document.getElementById('fechaPruebasInicio').value,
                    fechaPruebasFin: document.getElementById('fechaPruebasFin').value,
                    fechaListadoProvisional: document.getElementById('fechaListadoProvisional').value,
                    fechaListadoOficial: document.getElementById('fechaListadoOficial').value,
                    tipo: document.getElementById('tipo').value,
                    destinatarios: valoresCheckboxDes,
                    baremos: valoresCheckboxBar,
                    idiomas: valoresCheckboxIdi
                };

                console.log(postConvocatoriaData)

                fetch("https://localhost:8000/convocatorias/api/new", { // envío el post
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(postConvocatoriaData),
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Convocatoria aceptada con éxito:', data);
                    })
                    .catch(error => {
                        alert('Error al aceptar el usuario:', error);
                    });
            });
        });
    }


});