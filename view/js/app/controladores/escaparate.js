miApp.controller('miController', ['$scope', '$http', function ($scope, $http) {

    $scope.lista = [];
    //Traer los datos de los tipos de tienda
    $http({
        method: 'GET',
        url: '../../controller/cEscaparate.php'
    }).then(function successCallback(response) {
        $scope.lista = response.data.lista;
        console.log(response.data)
    }, function errorCallback(response) {
        alert(response.error);
    });
}]);