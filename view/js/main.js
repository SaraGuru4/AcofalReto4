//Botones modal login desplazamiento entre registro y login
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

const registrobtn = document.getElementById("registrate");
const loginbtn = document.getElementById("btnlogin");

//botón registro navbar, para cuando se haga click automáticamente salga la ventana del registro en vez de la de login
registrobtn.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});
//botón login navbar, para cuando se haga click automáticamente salga la ventana del login en vez de la de registro
loginbtn.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

//Botones de login y registro en el modal
signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

/*Jquery*/
$(document).ready(function () {

    $('.go-top ').on('click', function () {

        $("html, body").animate({
            scrollTop: 0
        }, 600);

    });


})

$( document ).scroll(function() {
   // console.log(window.pageYOffset != 0, window.pageYOffset );
    if (window.pageYOffset >=500) {
   
       //Nos sale
       $('.go-top').show();
   } else {
       //se oculta
       $('.go-top').hide();
   }
  });


/*Función para mostrar contraseña*/
function mostrarContrasena() {
    var password = document.getElementById("passwordRegistro");

    /*Si el tipo es password, lo ponemos a text para mostrar la contraseña*/
    if (password.type === "password") {

        password.type = "text";

        /*Limpiar div y cambiar el icono*/
        $("#cambiarIcono").html("");
        icono = "<i class='fas fa-eye-slash' onclick='mostrarContrasena()'></i>";
        $("#cambiarIcono").html(icono);

    } else {
        password.type = "password";
        $("#cambiarIcono").html("");
        icono = "<i class='fas fa-eye' onclick='mostrarContrasena()'></i>";
        $("#cambiarIcono").html(icono);
    }
}

/*Jquery*/
$(document).ready(function () {

    $('.go-top ').on('click', function () {

        $("html, body").animate({
            scrollTop: 0
        }, 600);

    });
    //Noticias Index

    $('#noticia').on('click', function () {

        $('html, body').animate({
            scrollTop: $("#noticiassection").offset().top - 200
        }, 1000);
    });

})

var menu = document.querySelector('.menu');
var listContainer = document.querySelector('.list-container');
var sticky = menu.offsetTop;

window.onscroll = () => {

    //Sticky Menu
    if (window.pageYOffset >= sticky) {

        menu.classList.add('sticky');

        document.getElementById("list").style.marginLeft = "100px";
        document.getElementById("list").style.marginTop = "25px";
        document.getElementById("list2").style.marginLeft = "400px";
        document.getElementById("list2").style.marginTop = "25px";
        document.getElementById("logo").style.marginTop = "5px";
        document.getElementById("logo").style.position = "absolute";
        document.getElementById("logo").src = "../Reto4/view/img/logo2.jpg";
        document.getElementById("logo").style.width = "40px";
        document.getElementById("logo").style.marginLeft = "40px";

        menu.style.height = "75px";

    } else {
        menu.classList.remove('sticky');

        document.getElementById("list").style.marginLeft = "30px";
        document.getElementById("list").style.marginTop = "0";
        document.getElementById("list2").style.marginLeft = "400px";
        document.getElementById("list2").style.marginTop = "0";
        document.getElementById("logo").style.marginTop = "0";
        document.getElementById("logo").style.position = "relative";
        document.getElementById("logo").src = "../Reto4/view/img/logo.jpg";
        document.getElementById("logo").style.width = "150px";

        menu.style.height = "120px";

    }

    //GO top
    if (window.pageYOffset >= 500) {

        //Nos sale
        $('.go-top').css('display', 'block');
    } else {
        //se oculta
        $('.go-top').css('display', 'none');
    }

}

function openMenu() {
    document.getElementById("menu").style.width = "300px";
    document.getElementById("menu").style.transition = "0.5s";

}

function closeMenu() {
    document.getElementById("menu").style.width = "0px";
}

/*Función para mostrar contraseña*/
function mostrarContrasena() {
    var password = document.getElementById("password");

    /*Si el tipo es password, lo ponemos a text para mostrar la contraseña*/
    if (password.type === "password") {

        password.type = "text";

        /*Limpiar div y cambiar el icono*/
        $("#cambiarIcono").html("");
        icono = "<i class='fas fa-eye-slash' onclick='mostrarContrasena()'></i>";
        $("#cambiarIcono").html(icono);

    } else {
        password.type = "password";
        $("#cambiarIcono").html("");
        icono = "<i class='fas fa-eye' onclick='mostrarContrasena()'></i>";
        $("#cambiarIcono").html(icono);
    }
}