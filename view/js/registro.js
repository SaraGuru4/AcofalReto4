$(document).ready(function () {

    $("#register").click(execRegistro);

})

function execRegistro() {

    campoUsuario = $("#nombreRegistro").val();
    campoCorreo = $("#emailRegistro").val();
    campoPassword = $("#passwordRegistro").val();


    $existeUsuario = true;

    if (campoUsuario == "") {
        $("#nombreRegistro").css("border", "2px solid red");
        $existeUsuario = false;
    } else {
        $("#nombreRegistro").css("border", "2px solid green");
    }
    if (campoCorreo == "") {
        $("#emailRegistro").css("border", "2px solid red")
        $existeUsuario = false;
    } else {
        $("#emailRegistro").css("border", "2px solid green");
    }
    if (campoPassword == "") {
        $("#passwordRegistro").css("border", "2px solid red")
        $existeUsuario = false;
    } else {
        $("#passwordRegistro").css("border", "2px solid green");
    }


    //Testea el campo correo si tiene puesto el @
    if (/\w+\@\w+\.\w+/.test(campoCorreo)) {

        $("#emailRegistro").css("border", "2px solid green");

    } else {

        $("#emailRegistro").css("border", "2px solid red");

        $existeUsuario = false;
    }

    //VALIDACIÓN DE LA CONTRASEÑA
    //LONGITUD
    if (campoPassword.length <= 6) {

        alert("La contraseña debe tener al menos 6 carácteres");
        $("#passwordRegistro").css("border", "2px solid red");
        $existeUsuario = false;
    } else {

        $("#passwordRegistro").css("border", "2px solid green");
    }

    //La contraseña con al menos un número
    numero = /[0-9]/;
    if (!numero.test(campoPassword)) {
        alert("La contraseña de tener al menos un número (0-9)!");
        $("#passwordRegistro").css("border", "2px solid red");
        $existeUsuario = false;
    } else {
        $("#passwordRegistro").css("border", "2px solid green");
    }

    //La contraseña con al menos una mayúscula
    mayuscula = /[A-Z]/;
    if (!mayuscula.test(campoPassword)) {
        alert("La contraseña de tener al menos una letra mayúscula");
        $("#passwordRegistro").css("border", "2px solid red");
        $existeUsuario = false;
    } else {
        $("#passwordRegistro").css("border", "2px solid green");
    }


    if ($existeUsuario == false) {
        alert("Faltan campos por rellenar");
        return false;

        //Existe usuario==true
    } else {

        nombreInsert = $("#nombreRegistro").val();
        emailInsert = $("#emailRegistro").val();
        passwordInsert = $("#passwordRegistro").val();
        adminInsert = "0";

        var url = "controller/cUsuarios.php";

        //Llamada fetch
        fetch(url, {
            method: 'GET',
        })

            .then(res => res.json()).then(result => {

                var list = result.list;

                permitirInsert = true;

                //recorre toda la lista de usuarios
                for (let i = 0; i < list.length; i++) {
                    //mira si el nombre de usuario y correo eletronico introducidos coincide con alguno de la base de datos
                    if (nombreInsert == list[i].nombreUsuario || emailInsert == list[i].correo) {
                        //Si es falso ponemos todos los campos en rojo
                        permitirInsert = false;

                        for (let i = 0; i < list.length; i++) {

                            if (nombreInsert == list[i].nombreUsuario) {

                                $("#nombreRegistro").css("border", "2px solid red");

                            }

                            if (emailInsert == list[i].correo) {

                                $("#emailRegistro").css("border", "2px solid red");

                            }
                        }

                        break;

                    }

                }
                //Si es true, permitimos el insert
                if (permitirInsert == true) {

                    var url = "controller/cRegistroUsuarioInsert.php";
                    var data = {
                        'nombreInsert': nombreInsert,
                        'emailInsert': emailInsert,
                        'passwordInsert': passwordInsert,
                        'adminInsert': adminInsert,

                    };

                    //Llamada fetch
                    fetch(url, {
                        method: 'POST', // or 'POST'
                        body: JSON.stringify(data), // data can be `string` or {object}!
                        headers: {
                            'Content-Type': 'application/json'
                        } // input data
                    })

                        .then(res => res.json()).then(result => {


                            nombreInsert = $("#nombreRegistro").html("");
                            emailInsert = $("#emailRegistro").html("");
                            passwordInsert = $("#passwordRegistro").html("");
                           
                            alert(result.error);
                            location.reload();

                        })
                        .catch(error => console.error('Error status:', error));

                } else {

                    alert("Ya existe un usuario con ese nombre de usuario o correo electronico");
                }

            })
            .catch(error => console.error('Error status:', error));
    }

}