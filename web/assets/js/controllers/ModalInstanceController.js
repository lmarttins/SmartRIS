angular
    .module('smartris')
    .controller('ModalInstanceController', ModalInstanceController);

ModalInstanceController.$inject = ['$scope', '$uibModalInstance', 'items', 'localStorageService'];

function ModalInstanceController($scope, $uibModalInstance, items, localStorageService) {
    $scope.items = items;
    
    $scope.ok = function () {
        var idPatient = $scope.items[0].id;
        saveLocalStorage(idPatient);
        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    function saveLocalStorage(id) {
        localStorageService.remove('patient');
        localStorageService.set('patient', id);
    }
}