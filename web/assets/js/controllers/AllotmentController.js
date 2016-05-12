angular
    .module('smartris')
    .controller('AllotmentController', AllotmentController);

AllotmentController.$inject = ['$scope', 'GuideService', '$sce'];

function AllotmentController($scope, GuideService, $sce) {

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
}