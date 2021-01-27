document.addEventListener('DOMContentLoaded', function () {
    const carritoTemplate = `
    <div class="productosCarrito" ng-hide="carrito.length === 0">
                <div class="shop" ng-repeat="tienda in carrito" style="background-color: {{carritoTemas[$index]}}">
                    <h4 style="text-align: center;">{{tienda.nombre}}</h4>
                    <div class="producto" ng-repeat="producto in tienda.productos">
                        <span>{{producto.nombreProducto}}</span>
                        <span class="producto-img" style="background-image: url('../img/productos/{{producto.foto}}')">

                        </span>
                        <span>
                            <img class="img-button" src="../img/carrito/back.png" alt="" height="15px" width="15px"
                                ng-hide="producto.seleccionado == 1"
                                ng-click="changeQuantity('substract', $parent.$index, $index)">
                            <span>{{producto.seleccionado}}</span>
                            <img class="img-button" src="../img/carrito/next.png" alt="" height="15px" width="15px"
                                ng-hide="producto.cantidad == producto.seleccionado"
                                ng-click="changeQuantity('sum', $parent.$index, $index)">
                        </span>
                        <span>
                            <input class="producto-price" type="text" value="0"
                                ng-value="subTotal( producto.seleccionado, producto.precio )" readonly>
                        </span>
                        <span>
                            <img class="remove img-button" src="../img/carrito/remove-shopping-cart.png" alt=""
                                height="30px" width="30px" ng-click="removeFromCart( $parent.$index, $index)">
                        </span>
                    </div>
                </div>
            </div>
            <div id="shopping-final-price" ng-model="precioFinal">Precio Final: {{precioFinal}} €</div>
            <div class="pay img-button" ng-click="forwardToInvoid()">
                <img src="../img/carrito/pay.png" alt="" height="30px" width="30px">
            </div>
    `
    if ( document.querySelector('.carrito') !== null ) document.querySelector('.carrito').innerHTML += carritoTemplate;
} )

miApp.controller("carrito", function ($scope, $http) {

    if (sessionStorage.getItem("carrito") === null) sessionStorage.setItem("carrito", JSON.stringify([]));

    $scope.carrito = JSON.parse(sessionStorage.getItem("carrito"));
    $scope.carritoTemas = getRandomColors(100);

    $scope.precioFinal = 0;

    updateTotal();

    $scope.addToCart = (producto, nombreTienda) => {
        // Los productos se agregarán al carrito con este formato
        const nProducto = {
            idStock: producto.idStock,
            idProducto: producto.objProducto.idProducto,
            nombreProducto: producto.objProducto.nombreProducto,
            foto: producto.objProducto.foto,
            precio: producto.precio - (producto.precio * (producto.descuento / 100)), // Aplicamos el descuento
            cantidad: producto.cantidad,
            seleccionado: 1
        }

        let tiendaI = -1;
        let productoI = -1;

        // Este bucle busca en el carrito si la tienda a la que pertenece el producto se encuentra en el carrito
        $scope.carrito.some((tienda, i) => {
            if (tienda.idTienda == producto.idTienda) {
                tiendaI = i;
                return true;
            }
        })
        // En caso de que la tienda se haya encontrado procedemos a mirar si el producto se ha añadido al carrito previamente
        if (tiendaI != -1) {
            const productExists = $scope.carrito[tiendaI].productos.some((item, i) => {
                if (item.idProducto == nProducto.idProducto) {
                    item.seleccionado++;
                    return true;
                }
            })
            // En caso de que no se hubiese añadido al carrito previamente lo añadimos con la información relevante
            if (!productExists) $scope.carrito[tiendaI].productos.push(nProducto)
        } else {
            // Si no existe la tienda en el carrito la añadimos junto al producto
            $scope.carrito.push({
                idTienda: producto.idTienda,
                nombre: nombreTienda,
                productos: [nProducto]
            })
        }

        updateTotal();
    }

    $scope.changeQuantity = (action, shopIndex, itemIndex) => {

        const producto = $scope.carrito[shopIndex].productos[itemIndex];
        switch (action) {
            case "sum":
                producto.cantidad > producto.seleccionado ? producto.seleccionado++ : alert('No hay suficientes unidades!');
                break;
            case "substract":
                producto.seleccionado > 1 ? producto.seleccionado-- : alert('Mínimo de unidades alcanzado!');
                break;
        }
        updateTotal();
    }

    $scope.subTotal = (amount, price) => {
        return parseFloat(amount * price).toFixed(2) + ' €';
    }

    $scope.removeFromCart = (shopIndex, itemIndex) => {

        $scope.carrito[shopIndex].productos.splice(itemIndex, 1);
        if ($scope.carrito[shopIndex].productos.length === 0) $scope.carrito.splice(shopIndex, 1);

        updateTotal();
    }

    $scope.forwardToInvoid = () => {
        location.href = 'factura.html';
    }

    $scope.pay = () => {
        $http({
            method: 'POST',
            url: '../../controller/cVenta.php',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify($scope.carrito)
        }).then(response => {
            let error = false;
            Array.from(response.data).forEach((array, i) => {
                if ( array.length === 0 ) {
                    console.log('Error -> ', array);
                    error = true;
                }
            })

            if (error) alert('Error durante el proceso de compra');
            else {
                alert('Compra realizada con éxito');
                sessionStorage.setItem("carrito", JSON.stringify([]));
                location.href = 'escaparate.html';
            }

        })
    }

    function updateTotal() {
        $scope.precioFinal = 0;
        $scope.carrito.forEach(tienda => {
            tienda.productos.forEach(producto => {
                $scope.precioFinal = $scope.precioFinal + (producto.seleccionado * producto.precio)
            })
        })

        $scope.precioFinal = parseFloat($scope.precioFinal).toFixed(2)

        sessionStorage.setItem("carrito", angular.toJson($scope.carrito));

    }

    function getRandomColors(amount) {
        const letters = '89ABC'.split('');

        let colours = [];

        for (let i = 0; i < amount; i++) {
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * letters.length)];
            }
            colours.push(color + '99'); // color + Alpha
        }
        return colours;
    }
});