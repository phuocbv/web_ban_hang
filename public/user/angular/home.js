app.controller('HomeController', function($scope, $http) {
    $scope.name = "sss";
    $scope.category;

    $scope.saveCategory = function() {
        alert($scope.category);
    };

    $http.get('/getProductTitle/1').then(function (response) {
        alert($scope.category);
    });
});
