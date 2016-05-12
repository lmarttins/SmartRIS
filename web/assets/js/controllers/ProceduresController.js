angular
    .module('smartris')
    .controller('ProceduresController', ProceduresController);

ProceduresController.$inject = ['$scope', 'ProcedureService', '$sce', 'localStorageService'];

function ProceduresController($scope, ProcedureService, $sce, localStorageService) {
    $scope.procedureSelected = [];

    var proceduresMock = [60000015, 60000023, 60000031, 60000040];

    ProcedureService.query(
        function(procedure) {
            $scope.multiselect.options = procedure.map(function(item){
              return {
                codTermo: item.CodTermo,
                termo: item.Termo,
                id: item.id
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
              return $sce.trustAsHtml(item.codTermo + ' - ' + item.termo);
            },
            labelTemplate: function(item){
              return $sce.trustAsHtml(item.termo);
            }
        }
    };

    $scope.save = function() {
        localStorageService.remove('procedures');
        localStorageService.set('procedures', proceduresMock.join(', '));
    }
}