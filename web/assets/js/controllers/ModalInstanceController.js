angular
    .module('smartris')
    .controller('ModalInstanceController', ModalInstanceController);

ModalInstanceController.$inject = ['$scope', '$uibModalInstance', 'items'];

function ModalInstanceController($scope, $uibModalInstance, items) {
    $scope.items = items;
    
    $scope.ok = function () {
        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
}