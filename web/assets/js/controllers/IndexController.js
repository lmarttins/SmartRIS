angular
    .module('smartris')
    .controller('IndexController', IndexController);

IndexController.$inject = ['$scope'];

function IndexController($scope) {
    $scope.title = 'Seja bem vindo ao SmartRIS';
}
