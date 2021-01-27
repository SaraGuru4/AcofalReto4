miApp.controller('miControlador', ['$scope', '$http', function ($scope, $http) {
    //Traer los datos de los productos
    $scope.productos = [];
    $scope.productosTienda = [];
    $http({
        method: 'GET',
        url: '../../controller/cProductos.php'
    }).then(function successCallback(response) {
        $scope.productos = response.data.list;
        console.log(response.data.list);
    }, function errorCallback(response) {
        alert(response.error);
    });


    //Trae los datos de los productos de esa tienda (Falta php) Revisar
    var idTienda= location.search.substring(1, location.search.length);
    var data={idTienda:idTienda};
    $http({
        method: 'POST',
        url: '../../controller/cStockByIdTienda.php',
        data: JSON.stringify(data),
        contentType: 'application/json',
        dataType: 'JSON'
        }).then(function successCallback(response) {
            $scope.productosTienda = response.data.list;
            console.log(response.data.list);
        }, function errorCallback(response) {
             alert(response.error);
    });
     
    //Muestra el formulario de insertar producto y el de Update
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('.mi-selector').select2();
            //Insert
            $('.sel').change(function(){
                //Recogemos la id del producto
                $scope.idProducto = $('.sel').val();
                verInsert($scope.idProducto);  
            });
            //Update
            $('.sel2').change(function(){
                //Recogemos la id de la tienda
                $scope.idProducto3 = $('.sel').val();
                verUpdate($scope.idProducto3);  
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

    //Mostramos el formulario update (Mirar si rellenar con Angular o con val())
    function verUpdate(idTienda){
        //$('#idProducto3').val(producto);
        //$('#idTienda3').val(location.search.substring(1, location.search.length));
        $('.update').css("display","flex");
        $('.update').css("flex-direction","column");
    }

    //Trae los datos de los productos de esa tienda (Stock)
    $scope.insertarStock=function(){
        //Meter aqui los valores del formulario y hacer un post a insertar
        var idProducto=$('#idProducto2').val();
        var idTienda=$('#idTienda2').val();
        var precio =$scope.precio;//$('#precio').val();
        var descuento= $scope.descuento;
        var cantidad= $scope.cantidad;
        var data={idProducto:idProducto,idTienda:idTienda,precio:precio,descuento:descuento,cantidad:cantidad};

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
           $scope.quitar();
        }

    //Borra los campos del formulario
     $scope.quitar =function(){
        $scope.idProducto2="";
        $scope.idTienda2="";
        $scope.precio="";
        $scope.descuento= "";
        $scope.cantidad= "";
        $('.insertar').css("display","none");
        $scope.idProducto3="";
        $scope.idTienda3="";
        $scope.precio3="";
        $scope.descuento3= "";
        $scope.cantidad3= "";
        $('.update').css("display","none");
    }
    //Eliminar Stock/Producto en tienda
    $scope.eliminarStock = function(idStock){
        var data={idStock:idStock};
        alert(idStock);
         $http({
           method: 'POST',
           url: '../../controller/cDeleteStock.php',
           data: JSON.stringify(data),
           contentType: 'application/json',
           dataType: 'JSON'
           }).then(function successCallback(response) {
                alert(response.data.error);
                console.log(response.data.error);
           }, function errorCallback(response) {
                alert("Algo ha fallado al procesar el delete!");
           });
           $scope.quitar();
        }
    }

    //Hacer una lista de tus productos y modificar y delete


    //Cuando acabe esto ir a admin y mirar bien y poner lo de añadir producto

}]);