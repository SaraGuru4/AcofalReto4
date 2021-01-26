miApp.controller('miControlador', ['$scope', '$http', function ($scope, $http) {

    //Recogemos los datos
    idTienda = location.search.substring(1, location.search.length);

    $scope.stock = [];
    $scope.tienda = [];

    $scope.action = 0;

    $scope.defaultImage = 'https://aliceasmartialarts.com/wp-content/uploads/2017/04/default-image.jpg';

    //Traer los datos de Tienda y los productos de la tienda
    var data = {
        idTienda: idTienda
    }
    $http({
        method: 'POST',
        url: '../../controller/cTiendaProductos.php',
        data: JSON.stringify(data),
        contentType: 'application/json',
        dataType: 'JSON'
    }).then(function successCallback(response) {

        $scope.tienda = response.data.tienda;
        $scope.stock = response.data.stock;

        console.log($scope.stock)
        if (location.href.match(/(.*)tienda(.*)/)) tienda3( Array.from(response.data.stock) )

    }, function errorCallback(response) {
        alert(response.error);
    });

    function tienda3(productos) {
        $scope.stock = [];

        let count = Math.round( productos.length / 3 );
        
        for ( let i = 0; i < count; i++ ) {
            let paginaCarousel = productos.splice(0, 3);
            $scope.stock.push(paginaCarousel)
        }

    }

}]);