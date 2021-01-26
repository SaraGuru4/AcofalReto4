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
        $('.insertarStock').css("display","flex");
    }
    function insesrtarProducto(){
        //Meter aqui los valores del formulario y hacer un post a insertar
    }

    //Hacer una lista de tus productos y modificar y delete


    //Cuando acabe esto ir a admin y mirar bien y poner lo de añadir producto

}]);