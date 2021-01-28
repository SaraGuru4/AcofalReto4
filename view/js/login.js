$(document).ready(function () {

    loggedVerify();
    //Login(Botón del modal)
    $("#login").click(login);
    //Logout
    $("#logout").click(logout);
});

//Verificamos si el usuario está conectado
function loggedVerify() {

    let url = "controller/cLoggedVerify.php";
    if (location.href.match(/(\/view)/i) !== null) url = "../../controller/cLoggedVerify.php";

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

            const idTienda = location.search.substring(1, location.search.length);


            //Si es el administrador de tienda puede ver el botón de administración de la tienda
            if (usuario.admin === idTienda) $('.adminProductos').css("display","block");

            //Si es admin 0 ó 1 redirecciona al index.html si intentan entrar en las páginas especificadas
            if ( ["0", "1"].includes(usuario.admin) && location.href.match(/(factura\.html|productos\.html)/i) !== null) location.href = '../../index.html';

            if (usuario.admin == 0) {
                console.log("Bienvenido de nuevo, " + usuario.nombreUsuario);
            } else if (usuario.admin == 1) {
                console.log("Hola de nuevo, " + usuario.nombreUsuario + " eres administrador número " + usuario.admin + ". Eres administrador de la tiendas");
            } else {
                console.log("Hola de nuevo, " + usuario.nombreUsuario + " eres administrador de la tienda número " +
                    usuario.admin)
            }


        } else {
            if (location.href.match(/(factura\.html|productos\.html)/i) !== null) location.href = '../../index.html';
            $('.addToCart').prop('disabled', true).removeClass( 'btn-primary' ).addClass( 'btn-outline-primary' )
        }
    })
        .catch(error => console.error('Error status:', error));
}


function login() {

    var url;

    location.href.match(/\/view/i) !== null ? url = "../../controller/cLogin.php" : url = "controller/cLogin.php";

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
            document.getElementById("email2").value = "";
            document.getElementById("password2").value = "";
            location.reload();

        } else {
            console.log(result.error);
        }

    })
        .catch(error => console.error('Error status:', error));
}

function logout() {
    var url;
    var redireccion;
   if(location.href.match(/\/view/i) !== null ){
    url = "../../controller/cLogout.php";
    redireccion='../../index.html';
     
   }else{
    url = "controller/cLogout.php";
    redireccion='index.html';
   }
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
        console.log("Has cerrado la sesión, esperamos tenerte de vuelta lo antes posible");
        location.href=redireccion;

    })
        .catch(error => console.error('Error status:', error));
}