//Objeto recuadro
//Objeto que permite recortar imagenes y trabajar con el fragmento recortado
//Sintaxis new Recuadro(x,y,ancho,alto,contenedor)
//x coordenada x del extremo superior del recuadro en pixels
//y coordenada y del extremo superior del recuadro en pixels
//ancho ancho en pixels
//alto alto en pixels

function Recuadro(x, y, ancho, alto, imagen) {
    this.x = x;
    this.y = y;
    this.ancho = ancho;
    this.alto = alto;
    this.imagen = imagen;
    this.contenedor = null;
    this.dom = null;
    this.mouseX = 0;
    this.mouseY = 0;
}

Recuadro.prototype.pinta = function (color = "black") {
    // Creo el div y configuro su estilo
    var rec = document.createElement("div");
    rec.style.position = "absolute";
    rec.style.top = 0;
    rec.style.left = 0;
    rec.style.width = this.ancho + "px";
    rec.style.height = this.alto + "px";
    rec.style.border = "1px solid " + color;
    rec.style.zIndex = 99;
    rec.id = 'recuadro';

    // Programo el movimiento del cuadradito
    rec.addEventListener("mousedown", this.pulsadoRaton.bind(this));
    rec.addEventListener("mousemove", this.moverRaton.bind(this));
    rec.addEventListener("mouseup", this.soltarRaton.bind(this));

    this.dom = rec;

    // // Creo un contenedor para la imagen donde añadir el div creado encima;
    var contenedor = document.createElement("div");
    contenedor.style.position = "relative";
    contenedor.style.display = "inline-block";
    this.contenedor = contenedor;

    // // Lo introduzco justo delante de la imagen, introduciendo la imagen dentro 
    // // y el cuadradito.
    this.imagen.parentNode.insertBefore(contenedor, this.imagen);

    // Mover la imagen al interior del contenedor
    contenedor.appendChild(this.imagen);

    // Agregar el recuadro al contenedor
    contenedor.appendChild(rec);
};

Recuadro.prototype.pulsadoRaton = function (ev) {
    // Si he pulsado el botón izquierdo muevo el cuadradito
    if (ev.buttons > 0 && ev.button === 0) {
        this.mouseX = ev.offsetX;
        this.mouseY = ev.offsetY;
    }
};

Recuadro.prototype.moverRaton = function (ev) {
    // Si he pulsado el botón izquierdo muevo el cuadradito
    if (ev.buttons > 0 && ev.button === 0) {
        this.dom.style.left = parseInt(this.dom.style.left) + (ev.offsetX - this.mouseX) + "px";
        this.dom.style.top = parseInt(this.dom.style.top) + (ev.offsetY - this.mouseY) + "px";
    }
};

Recuadro.prototype.soltarRaton = function (ev) {
    // Si he pulsado el botón izquierdo muevo el cuadradito
    // Borro el auxiliar del movimiento
    this.mouseX = 0;
    this.mouseY = 0;
    this.x = parseInt(this.dom.style.left);
    this.y = parseInt(this.dom.style.top);
};

Recuadro.prototype.recortar = function () {
    var c = document.createElement("canvas");
    var img = document.createElement("img");
    //defino el tamaÃ±o del canvas y la imagen
    c.width = this.ancho;
    c.height = this.alto;
    img.width = this.ancho;
    img.height = this.alto;
    var ctx = c.getContext("2d");
    ctx.drawImage(this.imagen, this.x, this.y, this.ancho, this.alto, 0, 0, this.ancho, this.alto);
    img.src = c.toDataURL();
    return c;
}