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


    $scope.idProducto2= "";
    $scope.idTienda2 = "";
    jQuery(document).ready(function($){
        $(document).ready(function() {
            //Recogemos los datos de la tienda
            $scope.idTienda = location.search.substring(1, location.search.length);
            $('.mi-selector').select2();
            $('.sel').change(function(){
                //Recogemos la id del producto
                $scope.idProducto = $('.sel').val();
                verInsert($scope.idTienda,$scope.idProducto);
                
            });
                
        });
    });

    


    //Con la idTienda y el idProducto hacemos el formulario de stock
    //Insertar en stock.
    function verInsert(tienda,producto){
        alert(tienda);
        $('#idProducto2').val(producto);
        $('#idTienda2').val(tienda);
        $('.insertarStock').css("display","flex");
        alert($scope.idProducto2);
    }

}]);