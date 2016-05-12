angular
    .module('smartris')
    .controller('GuidesController', GuidesController);

GuidesController.$inject = ['$scope', 'GuideService', 'localStorageService'];

function GuidesController($scope, GuideService, localStorageService) {
    var vm = this;

    vm.alertSuccess = false;

    $scope.save = function() {
        var newGuide = new GuideService({
            patient: localStorageService.get('patient'),
            procedures: localStorageService.get('procedures')
        });

        GuideService.save(newGuide, function(data){
            if (data.success) {
                vm.alertSuccess = true;
                localStorageService.remove('patient');
                localStorageService.remove('procedures');
            }
        });
    };
}