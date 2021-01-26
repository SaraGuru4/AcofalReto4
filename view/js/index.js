/*Jquery*/
$(document).ready(function () {

    cargarNoticias();

    //Carousel(Con la librería OwlCarousel), Autoplay Carousel
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 3,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 1200,
        autoplayHoverPause: true
    });
    $('.play').on('click', function () {
        owl.trigger('play.owl.autoplay', [1000])
    })
    $('.stop').on('click', function () {
        owl.trigger('stop.owl.autoplay')
    })


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
        document.getElementById("list2").style.marginLeft = "200px";
        document.getElementById("list2").style.marginTop = "25px";
        document.getElementById("logo").style.marginTop = "5px";
        document.getElementById("logo").style.position = "absolute";
        document.getElementById("logo").src = "view/img/index/logo2.jpg";
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
        document.getElementById("logo").src = "view/img/index/logo.jpg";
        document.getElementById("logo").style.width = "150px";

        menu.style.height = "120px";

    }
}

//Form login cuando se hace click en registrarse
function abrirLoginIndex() {
    //Acciones

    document.getElementById("light").style.display = "block";
    document.getElementById("fade").style.display = "block";
    document.getElementById("videoindex").style.display = "none";
    document.getElementById("bonossection").style.display = "none";
    document.getElementById("noticiassection").style.display = "none";
    document.getElementById("pietxt").style.display = "none";
    document.getElementById("footer").style.display = "none";

}
//Cerrar login en index
function cerrarLoginIndex() {
    document.getElementById("light").style.display = "none";
    document.getElementById("fade").style.display = "none";
    document.getElementById("videoindex").style.display = "block";
    document.getElementById("bonossection").style.display = "block";
    document.getElementById("noticiassection").style.display = "block";
    document.getElementById("pietxt").style.display = "block";
    document.getElementById("footer").style.display = "block";
}


//Abrir y cerrar menú Index
function openMenuIndex() {
    document.getElementById("menu").style.width = "300px";
    document.getElementById("menu").style.transition = "0.5s";
}

function closeMenuIndex() {
    document.getElementById("menu").style.width = "0px";
}

//Cargar las noticias de la página principal con json
function cargarNoticias() {

    var url = "view/json/noticias.json";

    fetch(url, {

            method: "GET",
            headers: {
                'Content-Type': 'application/json'
            }

        })
        .then(res => res.json()).then(result => {


            var myHtml = "";
            var noticias = result;

            for (let i = 0; i < noticias.length; i++) {

                myHtml += "<div class='col-md-4 mb-4' >" +
                    "<div class='card mb-4 box-shadow' id='card" + i + "'>" +
                    "<div class='imagen'>" +
                    "<img class='card-img-top' src='" + noticias[i].imagen + "'>" +
                    "</div>" +
                    "<div class='card-body'>" +
                    "<b><p class='card-text titulo'>" + noticias[i].titulo + "</p></b><br>" +
                    "<p class='card-text texto'>" + noticias[i].texto + "</p>" +
                    "<div class='d-flex justify-content-start align-items-center'>" +
                    "<small class='text-dark'>" + noticias[i].fecha + "</small>" +
                    "<div class='barra1'></div>" +
                    "<small class='text-dark'>" + noticias[i].tipo + "<i class='fas fa-share-alt'></i></small>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }
            //Metemos los cards en las noticias
            $("#noticias").html(myHtml);

        })
        .catch(error => console.error('Error status:', error));

}