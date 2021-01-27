miApp.controller('miControlador', ['$scope', '$http', function ($scope, $http) {
    //Traer los datos de los productos
    $scope.productos = [];
    $http({
        method: 'GET',
        url: '../../controller/cProductos.php'
    }).then(function successCallback(response) {
        $scope.productos = response.data.list;
        console.log(response.data.list)
    }, function errorCallback(response) {
        alert(response.error);
    });
    //Muestra el formulario de insertar producto
    $scope.idProducto2= "";
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('.mi-selector').select2();
            $('.sel').change(function(){
                //Recogemos la id del producto
                $scope.idProducto = $('.sel').val();
                verInsert($scope.idProducto);  
            });
                
        });
    });
    //Insertar en stock.
    function verInsert(producto){
        $('#idProducto2').val(producto);
        $('#idTienda2').val(location.search.substring(1, location.search.length));
        $('.insertar').css("display","flex");
        $('.insertar').css("flex-direction","column");
    }
    $scope.insertarStock=function(){
        //Meter aqui los valores del formulario y hacer un post a insertar
        var idProducto=$('#idProducto2').val();
        var idTienda=$('#idTienda2').val();
        var precio =$scope.precio;//$('#precio').val();
        var descuento= $scope.descuento;
        var cantidad= $scope.cantidad;
        var data={idProducto:idProducto,idTienda:idTienda,precio:precio,descuento:descuento,cantidad:cantidad};
        alert(idProducto+"..."+precio);

         $http({
           method: 'POST',
           url: '../../controller/cInsertStock.php',
           data: JSON.stringify(data),
           contentType: 'application/json',
           dataType: 'JSON'
           }).then(function successCallback(response) {
                alert(response.data.error);
                console.log(response.data.error);
           }, function errorCallback(response) {
                alert("Algo ha fallado al procesar el insert!");
           });
        }

    //Borra los campos del formulario
/*     $scope.quitar =function(){
        $scope.idProducto2="";
        $scope.idTienda2="";
        $scope.precio="";
        $scope.descuento= "";
        $scope.cantidad= "";
        //$('.insertar').css("display","none");
    } */

    //Hacer una lista de tus productos y modificar y delete


    //Cuando acabe esto ir a admin y mirar bien y poner lo de añadir producto

}]);