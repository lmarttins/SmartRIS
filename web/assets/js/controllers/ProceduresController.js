angular
    .module('smartris')
    .controller('ProceduresController', ProceduresController);

ProceduresController.$inject = ['$scope', '$resource', '$sce'];

function ProceduresController($scope, $resource, $sce) {
    $scope.procedures = [];

    var Procedures = $resource('web/index_dev.php/api/procedures');

    Procedures.query(
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
        showSelected: false,
        itemTemplate: function(item){
          return $sce.trustAsHtml(item.codTermo + ' - ' + item.termo);
        },
        labelTemplate: function(item){
          return $sce.trustAsHtml(item.termo);
        }
      }
    };
}