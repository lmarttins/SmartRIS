angular
    .module('smartris')
    .controller('AllotmentStepOneController', AllotmentStepOneController);

AllotmentStepOneController.$inject = ['$scope', 'GuideService', '$sce', 'localStorageService'];

function AllotmentStepOneController($scope, GuideService, $sce, localStorageService) {

    var vm = this;
    vm.guideSelected = [];
    vm.alertError = false;

    GuideService.query(
        function(procedure) {
            $scope.multiselect.options = procedure.map(function(item){
              return {
                id: item.id,
                provider: item.name
              };
            });
        },
        function(error) {
            console.log(error);
        }
    );

    $scope.multiselect = {
        selected: [],
        options: [],
        config: {
            hideOnBlur: false,
            showSelected: true,
            itemTemplate: function(item){
              return $sce.trustAsHtml(item.id + ' - ' + item.provider);
            },
            labelTemplate: function(item){
              return $sce.trustAsHtml(item.id + '-' + item.provider);
            }
        }
    };

    $scope.save = function() {
        vm.guideSelected = $scope.multiselect.selected.map(function(each){
            return each.id;
        });

        localStorageService.set('guides', vm.guideSelected.join(','));
    }
}