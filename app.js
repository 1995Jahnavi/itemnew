var app = angular.module('marvelDemo', ['ngRoute','ui.bootstrap']);


app.controller('MainCtrl', function($scope, $location, $http) {
  $scope.char={};
  $scope.showCharInfo= false;
  $scope.getCharacters = function(val) {
        $scope.timeStamp=  Date.now();
         $scope.publicKey="5234a931fdd1da574fb6133e31a6d02c";
        baseUrl= "http://localhost:8765/sales-orders/view/69.json";
    return $http.get(baseUrl, {
      params: {
        nameStartsWith: val,
        limit: 25,
        ts: $scope.timeStamp,
        apikey: $scope.publicKey 
      }
    }).then(function(response){
      $scope.charInfoArr=response.salesOrders;
      return response.salesOrders.map(function(item){
        
        return item.id;
      });
    });
  };

  $scope.selectCharacter=function (item){
    angular.forEach($scope.charInfoArr, function(obj, key){
      if(obj.name===item){
      
         if (obj.thumbnail){
           $scope.char.thumb= obj.thumbnail.path+"."+obj.thumbnail.extension;
         }else{
           $scope.char.thumb="";
         }
         
         $scope.char.name= obj.name;
         $scope.char.desc= obj.description;
         $scope.showCharInfo= true;
      }
       
    });
    
  }

});

