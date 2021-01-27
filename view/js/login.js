$(document).ready(function () {

    loggedVerify();
    //Login(Botón del modal)
    $("#login").click(login);
    //Logout
    $("#logout").click(logout);
});

//Verificamos si el usuario está conectado
function loggedVerify() {

    let url = "../../controller/cLoggedVerify.php";
    if (location.href.match(/(reto4\/index.html|reto4\/)/i) !== null) url = "controller/cLoggedVerify.php";

    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        } //input data
    })
        .then(res => res.json()).then(result => {

        console.log(result);

        var usuario = result.user;

        if (result.error === "no error") {
            $("#perfil").show();
            $(".botonLogout").show();
            $(".botonLogin").hide();
            $("#registrate").hide();
            $(".barra").hide();
            $("#perfilsidebar").show()


            document.getElementById("usuario").innerHTML = "Hola, " + usuario.nombreUsuario;


            if (usuario.admin == 0) {
                alert("Bienvenido de nuevo, " + usuario.nombreUsuario);
            } else if (usuario.admin == 1) {
                alert("Hola de nuevo, " + usuario.nombreUsuario + " eres administrador número " +
                    usuario.admin + ". Eres administrador de la tiendas");

            } else {
                alert("Hola de nuevo, " + usuario.nombreUsuario + " eres administrador número " +
                    usuario.admin)
            }


        }
    })
        .catch(error => console.error('Error status:', error));
}


function login() {

    var url = "controller/cLogin.php";
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
            'Content-Type': 'application/json',
            'DataType': 'json',
        } //input data
    })
        .then(res => res.json()).then(result => {

        // Actualiza la página solo en caso de que el mensaje sea no error
        if (result.error === 'no error') {
            /*document.getElementById("email2").value = "";
            document.getElementById("password2").value = "";
            location.reload();*/

        } else {
            alert(result.error);
        }

    })
        .catch(error => console.error('Error status:', error));
}

function logout() {
    var url = "controller/cLogout.php";
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
        alert("Has cerrado la sesión, esperamos tenerte de vuelta lo antes posible");
        location.reload();

    })
        .catch(error => console.error('Error status:', error));
}