window.addEventListener('DOMContentLoaded', function () {

    if (window.location.pathname === '/baremacion/convocatoria') {
        var pdfButtons = document.querySelectorAll('.pdf');
        var modal = document.getElementById('modalNotas');

        pdfButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                if (modal != undefined) {
                    modal.style.display = 'none';
                }

                // Determinar qué modal se debe usar
                // if (button.id === 'pdfNotas') {
                //     modal = document.getElementById('modalNotas');
                // } else {
                //     modal = document.getElementById('modalIdioma');
                // }

                modal = document.getElementById('modalNotas');

                // Crear iframe para mostrar el PDF
                var iframe = document.createElement('iframe');
                iframe.type = 'application/pdf';
                iframe.src = '../pdf/' + button.getAttribute('data-url');
                iframe.style.width = '500px';
                iframe.style.height = '300px';

                const posicionX = button.getBoundingClientRect().x + button.getBoundingClientRect().width;
                const posicionY = button.getBoundingClientRect().y - 305;

                modal.style.right = `${posicionX}px`;
                modal.style.top = `${posicionY}px`;
                modal.style.display = 'block';
                // Limpiar contenido existente antes de agregar el iframe
                modal.innerHTML = '';
                modal.appendChild(iframe);
            });
        });

        document.addEventListener('click', function (event) {
            if (modal.style.display === 'block' && !modal.contains(event.target) && !event.target.classList.contains('pdf')) {
                modal.style.display = 'none';
            }
        });

        const inputs = document.querySelectorAll('#baremacion input');

        inputs.forEach(element => {
            element.addEventListener('input', function (ev) {
                var fila = this.closest('tr');
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const id = urlParams.get('id');

                const postSolicitudData = {
                    idConvocatoria: id,
                    idCandidato: fila.querySelector('.dni').getAttribute('data-id'),
                    idItem: ev.target.getAttribute('data-id'),
                    nota: ev.target.value,
                };

                console.log(postSolicitudData)

                fila.querySelector('.cargando').style.display = 'block'
                fila.querySelector('.cargando').classList.add('rotate-center')
                setTimeout(() => {
                    fila.querySelector('.cargando').style.display = 'none'
                    fila.querySelector('.cargando').classList.remove('rotate-center')
                }, 2000);

                fetch("https://localhost:8000/baremacion/api/new", { // envío el post
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(postSolicitudData),
                })
                    .then(response => response.json())
                    .then(data => {
                    })
                    .catch(error => {
                    });
            })
        });

        function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("myTable");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;

                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        fetch("https://localhost:8000/baremacion/api")
            .then(x => x.json())
            .then(y => {
                var tabla = document.getElementById("baremacion");
                var tbody = tabla.querySelector('tbody');
                var filas = tbody.querySelectorAll('tr');

                for (let i = 0; i < y.length; i++) {
                    filas.forEach(fila => {
                        if (y[i].idCan == fila.querySelector('.dni').getAttribute('data-id')) {
                            var dataIdValue = y[i].idItem;
                            var inputElement = fila.querySelector('[data-id="' + dataIdValue + '"]');
                            if (inputElement) {
                                inputElement.value = y[i].nota;
                            }
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });


    }

})