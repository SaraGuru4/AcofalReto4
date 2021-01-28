//MENU STICKY CONTACTO
var menu = document.querySelector('.menu');
var listContainer = document.querySelector('.list-container');
var sticky = menu.offsetTop;

window.onscroll = () => {

    if (window.pageYOffset >= sticky) {

        menu.classList.add('sticky');

        document.getElementById("list").style.marginLeft = "100px";
        document.getElementById("list").style.marginTop = "25px";
        document.getElementById("list2").style.marginLeft = "200px";
        document.getElementById("list2").style.marginTop = "25px";
        document.getElementById("logo").style.marginTop = "5px";
        document.getElementById("logo").style.position = "absolute";
        document.getElementById("logo").src = "../../view/img/index/logo2.jpg";
        document.getElementById("logo").style.width = "40px";
        document.getElementById("logo").style.marginLeft = "40px";

        menu.style.height = "75px";

    } else {
        menu.classList.remove('sticky');

        document.getElementById("list").style.marginLeft = "30px";
        document.getElementById("list").style.marginTop = "0";
        document.getElementById("list2").style.marginLeft = "200px";
        document.getElementById("list2").style.marginTop = "0";
        document.getElementById("logo").style.marginTop = "0";
        document.getElementById("logo").style.position = "relative";
        document.getElementById("logo").src = "../../view/img/index/logo.jpg";
        document.getElementById("logo").style.width = "150px";

        menu.style.height = "120px";

    }
}

$(document).ready(function () {


    loggedVerify();
    //Login(Botón del modal)
    $("#login").click(login);
    //Logout
    $("#logout").click(logout);
})


//Form login cuando se hace click en registrarse
function abrirLoginContacto() {
    //Acciones

    document.getElementById("light").style.display = "block";
    document.getElementById("fade").style.display = "block";
}

function cerrarLoginContacto() {
    document.getElementById("light").style.display = "none";
    document.getElementById("fade").style.display = "none";

}

function openMenuContacto() {
    document.getElementById("menu").style.width = "300px";
    document.getElementById("menu").style.transition = "0.5s";
}

function closeMenuContacto() {
    document.getElementById("menu").style.width = "0px";
}

/*Función para enviar el comentario*/
function enviarComentario() {

    var titulo = $("#asunto").val();
    var texto = $("#mensaje").val();

    if (titulo == "") {
        $("#asunto").css("border", " 2px solid red");
        $("#textcomment1").html("Introduce un título para su mensaje");

    } else {
        $("#asunto").css("border", " 2px solid green");
        $("#textcomment1").html("");
    }
    if (texto == "") {
        $("#mensaje").css("border", " 2px solid red");
        $("#textcomment2").html("Rellena el mensaje");

    } else {
        $("#mensaje").css("border", " 2px solid green");
        $("#textcomment2").html("");

    }

    if (texto !== "" && titulo !== "") {

        var url = "../../controller/cInsertComentario.php";
        var data = {
            "titulo": titulo,
            "texto": texto
        };


        fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(res => res.json()).then(result => {

            console.log("Comentario enviado correctamente.");
            location.reload();
        })
            .catch(error => console.error('Error status:', error));

    }
}

//Verificamos si el usuario está conectado
function loggedVerify() {
    var url = "../../controller/cLoggedVerify.php";

    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        } //input data
    })
        .then(res => res.json()).then(result => {

        console.log(result);
        //Si no hay error

        var usuario = result.user;
        if (result.error == "no error") {
            $("#perfil").show();
            $(".botonLogout").show();
            $(".botonLogin").hide();
            $("#registrate").hide();
            $(".barra").hide();
            $("#perfilsidebar").show();


            document.getElementById("usuario").innerHTML = "Hola, " + usuario.nombreUsuario;

            if (usuario.admin == 0) {
                console.log("Bienvenido de nuevo, " + usuario.nombreUsuario);
            } else if (usuario.admin == 1) {
                console.log("Bienvenido, " + usuario.nombreUsuario + " eres admnistrador número " +
                    usuario.admin);
            } else {
                console.log("Hola de nuevo, " + usuario.nombreUsuario + " eres administrador número " +
                    usuario.admin)
            }
        }
    })
        .catch(error => console.error('Error status:', error));
}

function login() {
    var url = "../../controller/cLogin.php";
    correo = $("#email2").val();
    password = $("#password2").val();

    var data = {
        'correo': correo,
        'password': password
    };

    fetch(url, {
        method: 'POST', // or 'POST'
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers: {
            'Content-Type': 'application/json'
        } //input data
    })
        .then(res => res.json()).then(result => {
        //	console.log(result.error);
        console.log(result.error);

        // Actualiza la página solo en caso de que el mensaje sea no error
        if (result.error == "no error") {
            location.reload();
            document.getElementById("email2").value = "";
            document.getElementById("password2").value = "";

        } else {
            console.log(result.error);
        }

    })
        .catch(error => console.error('Error status:', error));
}


function logout() {
    var url = "../../controller/cLogout.php";
    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        } //input data
    })
        .then(res => res.json()).then(result => {

        console.log(result.error);

        //Acciones
        $("#perfil").hide();
        $(".botonLogout").hide();
        $(".botonLogin").show();
        sessionStorage.removeItem("carrito")
        //console.log("Has cerrado la sesión, esperamos tenerte de vuelta lo antes posible");
        window.location.href = "../../index.html";

    })
        .catch(error => console.error('Error status:', error));
}