miApp.controller('miController', ['$scope', '$http', function ($scope, $http) {
    //RECOGEMOS LA VARIABLE DE PROVINCIA QUE NOS TRAE:
    idTipo = location.search.substring(1, location.search.length);
    //alert(idTipo);
    $scope.tienda = [];
    $scope.tipoTienda = [];
    var data = {idTipo: idTipo}
    //Traer los datos de TipoTienda y de las Tiendas de ese TipoTienda
    $http({
        method: 'POST',
        url: '../../controller/cTipoTienda.php',
        data: JSON.stringify(data),
        contentType: 'application/json',
        dataType: 'JSON'
    }).then(function successCallback(response) {
        $scope.tienda = response.data.tienda;
        $scope.tipoTienda = response.data.tipo;
        console.log($scope.tienda);
        console.log($scope.tipoTienda);
    }, function errorCallback(response) {
        alert(response.error);
    });
}]);

