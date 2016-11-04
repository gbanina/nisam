<!doctype html>
<html lang="en" ng-app="nisamApp">
  <head>
    <title>My Angular App</title>

  </head>
  <body ng-controller="TodosController">
    <ul>
        <li ng-repeat="vote in votes">
            @{{vote.name}}, @{{vote.votes}}
        </li>
    </ul>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
