window.addEventListener('DOMContentLoaded', function () {

    if (window.location.pathname === '/convocatorias/form') {
        var foto = document.getElementById('modalFoto');
        var modalElemento = document.getElementById('modalSeleccion');

        foto.addEventListener('click', function (event) {
            const fotoRect = foto.getBoundingClientRect();
            const margenPorcentaje = 1.5;
            const margenX = (fotoRect.width * margenPorcentaje) / 100;
            const margenY = (fotoRect.height * margenPorcentaje) / 100;

            const posicionX = foto.getBoundingClientRect().x + margenX;
            const posicionY = foto.getBoundingClientRect().y + foto.getBoundingClientRect().height - margenY;

            modalElemento.style.left = `${posicionX}px`;
            modalElemento.style.top = `${posicionY}px`;
            modalElemento.style.display = 'block';
        })

        document.addEventListener('click', function (event) {
            if (!modalElemento.contains(event.target) && event.target !== foto) {
                modalElemento.style.display = 'none';
            }
        });

        fileInput.addEventListener('change', function (event) {
            modalElemento.style.display = 'none'
            var reader = new FileReader();

            reader.readAsDataURL(this.files[0]);

            reader.onload = function (event) {
                foto.style.backgroundImage = `url('${event.target.result}')`;
            };
        });

        var webcamButt = document.getElementById('webcamButt')

        webcamButt.addEventListener('click', function (ev) {
            ev.preventDefault()
            modalElemento.style.display = 'none'
            var fondo = document.createElement("div");

            fondo.style.position = "fixed";
            fondo.style.top = 0;
            fondo.style.left = 0;
            fondo.style.width = "100%";
            fondo.style.height = "100%";
            fondo.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
            fondo.style.zIndex = 99;

            document.body.appendChild(fondo);

            const contenedor = document.getElementById('contenedorWebcam')
            contenedor.style.display = 'flex'
            const player = document.getElementById('player');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            const captureButton = document.getElementById('capture');

            const constraint = {
                video: true,
            };

            var rec = foto.getBoundingClientRect()
            var recuadro = new Recuadro(rec.x, rec.y, rec.width, rec.height, canvas);

            captureButton.addEventListener('click', (ev) => {
                ev.preventDefault()
                // Draw the video frame to the canvas.
                context.drawImage(player, 0, 0, canvas.width, canvas.height);

                if (document.getElementById('recuadro')) {
                    document.getElementById('recuadro').remove()
                    recuadro.pinta()
                } else {
                    recuadro.pinta()
                }
            });

            var saveWebcam = document.getElementById('saveButton')

            saveWebcam.addEventListener('click', (ev) => {
                ev.preventDefault()
                contenedor.style.display = 'none'
                fondo.style.display = 'none'
                var canvasRecortado = recuadro.recortar();
                var dataURL = canvasRecortado.toDataURL();

                foto.style.backgroundImage = `url('${dataURL}')`;
                player.srcObject = null;
            })

            var exit = document.getElementById('exitButton')

            exit.addEventListener('click', (ev) => {
                ev.preventDefault()
                contenedor.style.display = 'none'
                fondo.style.display = 'none'
                player.srcObject = null;
            })

            navigator.mediaDevices.getUserMedia(constraint).then((stream) => {
                player.srcObject = stream;
            });
        })

        var pdf = document.querySelectorAll('.pdf');
        var input, modal;

        pdf.forEach(element => {
            element.addEventListener('click', function (ev) {
                ev.preventDefault();

                if (element.id === 'notas') {
                    input = document.getElementById('notas');
                    modal = document.getElementById('modalNotas');
                } else {
                    input = document.getElementById('idioma');
                    modal = document.getElementById('modalIdioma');
                }

                document.addEventListener('click', function (event) {
                    if (!modal.contains(event.target)  && event.target !== element) {
                        modal.style.display = 'none';
                    }
                });

                var lector = new FileReader();
                lector.onload = function (ev) {
                    var iframe = document.createElement('iframe');
                    iframe.type = 'application/pdf';
                    iframe.src = this.result + '#page=1';
                    iframe.style.width = '500px';
                    iframe.style.height = '300px';

                    const posicionX = element.getBoundingClientRect().x;
                    const posicionY = element.getBoundingClientRect().y - 305;

                    modal.style.left = `${posicionX}px`;
                    modal.style.top = `${posicionY}px`;
                    modal.style.display = 'block';
                    // Borrar contenido existente antes de agregar el iframe
                    modal.innerHTML = '';
                    modal.appendChild(iframe);

                    modal.style.display = 'block';
                };

                lector.readAsDataURL(input.files[0]);
            });
        });


        var enviar = document.getElementById('enviar')

        enviar.addEventListener('click', function (ev) {
            ev.preventDefault();
            var form = document.getElementsByTagName('form')[0]
            form.valida();

            var image = window.getComputedStyle(document.getElementById('modalFoto')).getPropertyValue('background-image')

            if (image != 'url("https://localhost:8000/assets/img/taman%CC%83o-foto-dni.jpg")') {
                document.getElementById('fileInput').className = 'valido'
                foto.style.border = '1px solid green'
            }

            var elementosDeEntrada = document.querySelectorAll('input')

            var todosValidos = Array.from(elementosDeEntrada).every(function (elemento) {
                return elemento.classList.contains('valido');
            });

            if (todosValidos) {
                console.log('yepa')
            }
        })

    }
})