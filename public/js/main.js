var myApp = angular.module('nisamApp',[]);
myApp.controller('TodosController', [ '$scope', '$http','$interval', TodosController]);

function TodosController($scope, $http, $interval){

    $scope.reload = function () {
        $http.get('votes').success(function(votes){
            $scope.votes = votes;
            $(".piemenu ul").piemenu("render");
        });
      };

      $scope.reload();
      $interval($scope.reload, 5000);
      $scope.$on('ngRepeatFinished', function ( e ) {
        console.log(this,e);
    });
}

myApp.controller('OrdersController', [ '$scope', '$http','$interval', OrdersController]);

function OrdersController($scope, $http, $interval){

    $scope.reload = function () {
        $http.get('orders').success(function(orders){
            $scope.orders = orders;
        });
      };

      $scope.reload();
      $interval($scope.reload, 5000);
}
