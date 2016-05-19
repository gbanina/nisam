var myApp = angular.module('nisamApp',[]);
myApp.controller('TodosController', [ '$scope', '$http','$interval', TodosController]);

function TodosController($scope, $http, $interval){

    $scope.reload = function () {
        $http.get('votes').success(function(votes){
            $scope.votes = votes;
        });
      };

      $scope.reload();
      $interval($scope.reload, 5000);
}
