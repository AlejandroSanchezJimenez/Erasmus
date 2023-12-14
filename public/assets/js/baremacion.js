window.addEventListener('DOMContentLoaded', function () {

    if (window.location.pathname === '/baremacion/convocatoria') { //aseguro la ruta
        var pdfButtons = document.querySelectorAll('.pdf');
        var modal = document.getElementById('modalNotas');

        pdfButtons.forEach(button => { // por cada uno de los botones de ver pdf añadimos un listener que muestra el pdf con los datos guardados
            button.addEventListener('click', function (event) {
                event.preventDefault();

                if (modal != undefined) {
                    modal.style.display = 'none';
                }

                modal = document.getElementById('modalNotas');

                var iframe = document.createElement('iframe');
                iframe.type = 'application/pdf';
                iframe.src = '../pdf/' + button.getAttribute('data-url');
                iframe.style.width = '450px';
                iframe.style.height = '300px';

                const posicionX = button.getBoundingClientRect().x + button.getBoundingClientRect().width;
                const posicionY = button.getBoundingClientRect().y - 305;

                modal.style.left = `${posicionX}px`;
                modal.style.top = `${posicionY}px`;
                modal.style.display = 'block';

                modal.innerHTML = '';
                modal.appendChild(iframe);
            });
        });

        document.addEventListener('click', function (event) { // salir del modal clicando fuera
            if (modal.style.display === 'block' && !modal.contains(event.target) && !event.target.classList.contains('pdf')) {
                modal.style.display = 'none';
            }
        });

        const inputs = document.querySelectorAll('#baremacion input');

        inputs.forEach(element => { // por cada uno de los inputs al modificarlo guardo la baremacion de ese item y muestro un div de carga
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

                fetch("https://localhost:8000/baremacion/api/new", {
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

        fetch("https://localhost:8000/baremacion/api") // relleno con los datos de baremacion en caso de que haya
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

        function search() { // buscador para facilitar la baremacion
            var num_cols, display, input, filter, table_body, tr, td, i, txtValue; 
            num_cols = 3;
            input = document.getElementById("searcher");
            filter = input.value.toUpperCase();
            table_body = document.getElementById("baremacion");
            tbody = table_body.querySelector('tbody');
            tr = tbody.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                display = "none";
                for (j = 0; j < num_cols; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            display = "";
                        }
                    }
                }
                tr[i].style.display = display;
            }
        }

        this.document.getElementById('searcher').addEventListener('input', function() { // llamada al buscador
            search()
        })
    }

})