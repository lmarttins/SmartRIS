angular
    .module('smartris')
    .controller('ProceduresController', ProceduresController);

ProceduresController.$inject = ['$scope', 'ProcedureService', '$sce', 'localStorageService'];

function ProceduresController($scope, ProcedureService, $sce, localStorageService) {
    vm = this;
    vm.procedureSelected = [];

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
        vm.procedureSelected = $scope.multiselect.selected.map(function(each){
            return each.codTermo;
        });

        localStorageService.set('procedures', vm.procedureSelected.join(','));
    }
}