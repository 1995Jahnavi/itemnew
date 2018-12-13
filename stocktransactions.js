var app = angular.module("MyApp", []);

app.controller("PostsCtrl", function($scope, $http) {

  var pendingTask;
  var warehouse;

  if ($scope.search === undefined) {
    $scope.search = "Pittsburgh";
    getData();
  }
$scope.warehousechange = function() {
      console.log("asfsdfgdg");
	getData();
  };

 $scope.itemchange = function() {
      console.log("asfsdfgdg");
	getData();
  };
