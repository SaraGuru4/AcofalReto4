miApp.controller('miControlador', ['$scope', '$http', function ($scope, $http) {

    //Recogemos los datos
    idTienda = location.search.substring(1, location.search.length);

    $scope.stock = [];
    $scope.tienda = [];

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
        if (location.href.match(/(.*)tienda(.*)/)) tienda( Array.from(response.data.stock) )

    }, function errorCallback(response) {
        alert(response.error);
    });

    $scope.deleteProducto = ( idStock ) => {

        const data = {
            idStock: idStock
        }

        $http({
            method: 'POST',
            url: '../../controller/cDeleteStock.php',
            data: JSON.stringify(data),
            contentType: 'application/json',
            dataType: 'JSON'
        }).then(function successCallback(response) {

            alert( response.data.error )
            if ( response.data.error !== "Error al eliminar" ) location.reload();

        }, function errorCallback(response) {
            alert(response.data.error);
        });
    }

    function tienda(productos) {
        $scope.stock = [];

        let count = Math.round(productos.length / 3);

        for (let i = 0; i < count; i++) {
            let paginaCarousel = productos.splice(0, 3);
            $scope.stock.push(paginaCarousel)
        }
    }

}]);