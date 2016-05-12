angular
    .module('smartris')
    .controller('AllotmentStepTwoController', AllotmentStepTwoController);

AllotmentStepTwoController.$inject = ['$scope', 'AllotmentService', '$sce', 'localStorageService'];

function AllotmentStepTwoController($scope, AllotmentService, $sce, localStorageService) {
    var vm = this;
    vm.alertSuccess = false;

    $scope.save = function() {
        var newAllotment = new AllotmentService({
            guides: localStorageService.get('guides')
        });

        AllotmentService.save(newAllotment, function(data) {
            if (data.success) {
                vm.alertSuccess = true;
                localStorageService.remove('guides');
            }
        });
    }
}