HTMLInputElement.prototype.estaRelleno = function () {
    var correcto = false;
    if (this.value !== "") {
        correcto = true;
    }

    return correcto;
}

HTMLInputElement.prototype.validarCheckbox = function () {
    if (this.type === 'checkbox' && this.checked == true) {
        return true;
    } else {
        return false;
    }
};

HTMLInputElement.prototype.esEdad = function () {
    if (this.value == parseInt(this.value) && this.value > 0 && this.value < 120) {
        return true;
    } else {
        return false;
    }
}

HTMLInputElement.prototype.esDouble = function () {
    if (!isNaN(parseFloat(this.value)) && isFinite(this.value)) {
        return true;
    } else {
        return false;
    }
};

HTMLInputElement.prototype.esInt = function () {
    if (Number.isInteger(parseFloat(this.value))) {
        return true;
    } else {
        return false;
    }
};

HTMLInputElement.prototype.esDNI = function () {
    var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
    var correcto = false;
    if (this.value !== "") {
        var partes = (/^(\d{8})([TRWAGMYFPDXBNJZSQVHLCKET])$/i).exec(this.value);
        if (partes) {
            correcto = (letras[partes[1] % 23] === partes[2].toUpperCase());
        }
    }
    return correcto;
}

HTMLInputElement.prototype.esFecha = function () {
    var fecha = new Date(this.value);

    // Verificar si la fecha es válida y si el año es mayor que 1900
    if (!isNaN(fecha.getTime()) && fecha.getFullYear() > 1900) {
        // Verificar si el año, mes y día coinciden con los valores originales
        // Esto ayuda a manejar casos como 2020-02-30, que no deberían ser válidos
        var esFechaValida =
            fecha.getFullYear() === parseInt(this.value.substr(0, 4), 10) &&
            fecha.getMonth() === parseInt(this.value.substr(5, 2), 10) - 1 &&
            fecha.getDate() === parseInt(this.value.substr(8, 2), 10);

        return esFechaValida;
    } else {
        return false;
    }
}

HTMLSelectElement.prototype.seleccionado = function () {
    if (this.value != '') {
        return true
    } else {
        return false
    }
}

HTMLFormElement.prototype.valida = function () {
    var elementos = document.querySelectorAll("input[data-valida]");
    var respuesta = true;

    elementos.forEach(function (elemento) {
        var tipo = elemento.getAttribute("data-valida");
        var respuestaCampo = false;

        switch (tipo) {
            case "nombre":
                respuestaCampo = elemento.estaRelleno();
                break;
            case "edad":
                respuestaCampo = elemento.esEdad();
                break;
            case "DNI":
                respuestaCampo = elemento.esDNI();
                break;
            case "fecha":
                respuestaCampo = elemento.esFecha();
                break;
            case "select":
                respuestaCampo = elemento.seleccionado();
                break;
            case "chkbox":
                respuestaCampo = elemento.validarCheckbox();
                break;
            case "int":
                respuestaCampo = elemento.esInt();
                break;
            case "double":
                respuestaCampo = elemento.esDouble();
                break;
        }

        respuesta = respuesta && respuestaCampo;

        if (respuestaCampo) {
            elemento.classList.add("valido");
            elemento.classList.remove("invalido");
        } else {
            elemento.classList.add("invalido");
            elemento.classList.remove("valido");
        }
    });

    return respuesta;
}

HTMLFormElement.prototype.validaOneByOne = function (input) {
    var respuesta = true;

    var tipo = input.getAttribute("data-valida");
    var respuestaCampo = false;

    switch (tipo) {
        case "nombre":
            respuestaCampo = input.estaRelleno();
            break;
        case "edad":
            respuestaCampo = input.esEdad();
            break;
        case "DNI":
            respuestaCampo = input.esDNI();
            break;
        case "fecha":
            respuestaCampo = input.esFecha();
            break;
        case "select":
            respuestaCampo = input.seleccionado();
            break;
        case "chkbox":
            respuestaCampo = input.validarCheckbox();
            break;
        case "int":
            respuestaCampo = input.esInt();
            break;
        case "double":
            respuestaCampo = input.esDouble();
            break;
    }

    respuesta = respuesta && respuestaCampo;

    if (respuestaCampo) {
        input.classList.add("valido");
        input.classList.remove("invalido");
    } else {
        input.classList.add("invalido");
        input.classList.remove("valido");
    }

    return respuesta;
}