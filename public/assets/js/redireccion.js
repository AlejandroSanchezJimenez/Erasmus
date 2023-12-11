window.addEventListener("load", function () { // redireccionado de todas las páginas desde js 

    document.getElementById("home").addEventListener("click", function () {
        window.location.href = "/";
    });

    document.getElementById("logo").addEventListener("click", function () {
        window.location.href = "/";
    });

    document.getElementById("proyectos").addEventListener("click", function () {
        window.location.href = "/proyectos";
    });

    document.getElementById("convocatorias").addEventListener("click", function () {
        window.location.href = "/convocatorias";
    });

    document.getElementById("baremar").addEventListener("click", function () {
        window.location.href = "/baremacion";
    });

    if ((window.location.pathname === '/login')) {
        this.document.querySelector('#loginbtn').addEventListener('click',function() {
            window.history.back();
        })

    } else if (window.location.pathname === '/convocatorias') {
        var buttons = document.querySelectorAll(".expandInfo");

        buttons.forEach(function (button) {
            button.addEventListener("click", function () {
                var conId = this.getAttribute("data-id");
                window.location.href = "/convocatorias/form?conId=" + conId;
            });
        });

        document.getElementById("newConvo").addEventListener("click", function () {
            window.location.href = "/convocatorias/new";
        });
    } else if (window.location.pathname === '/proyectos') {
        document.getElementById("newProy").addEventListener("click", function () {
            window.location.href = "/proyectos/new";
        });

        var buttons = document.querySelectorAll(".expandInfo");

        buttons.forEach(function (button) {
            button.addEventListener("click", function () {
                var proId = this.getAttribute("data-id");
                window.location.href = "/convocatorias?proId=" + proId;
            });
        });
    } else if (window.location.pathname === '/checkTest') {
        var buttonsCheck = document.querySelectorAll(".check");

        buttonsCheck.forEach(function (button) {
            button.addEventListener("click", function () { // obtengo parametros como get
                var inId = this.getAttribute("data-inId");
                var exId = this.getAttribute('data-exid');
                window.location.href = "/test?inId=" + inId + '&exId=' + exId;
            });
        });

        document.getElementById("cerrarSesion").addEventListener("click", function () {
            window.location.href = "/logout";
        });

        document.getElementById("pageBack").addEventListener("click", function () {
            window.history.back();
        });
    } else if (window.location.pathname === '/baremacion') {
        var buttonsCheck = document.querySelectorAll(".convocatoria");

        buttonsCheck.forEach(function (button) {
            button.addEventListener("click", function () { // obtengo parametros como get
                var conId = this.getAttribute("data-id");
                window.location.href = "/baremacion/convocatoria?id=" + conId;
            });
        });
    }

});