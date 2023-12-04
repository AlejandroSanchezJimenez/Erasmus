// var fichero = document.getElementById('fichero');
// var contenedor = document.getElementById('contenedor');

// fichero.addEventListener('change', function (ev) {
//     var lector = new FileReader();
//     lector.onload = function (ev) {
//         var iframe = document.createElement('iframe');
//         iframe.src = this.result;
//         iframe.type = 'application/pdf';
//         iframe.style.width = '100%';
//         iframe.style.height = '500px';
//         contenedor.innerHTML = ''; // Limpia el contenedor antes de agregar el nuevo iframe
//         contenedor.appendChild(iframe);
//     }
//     lector.readAsDataURL(this.files[0]);
// });