angular
    .module('smartris')
    .controller('GuidesController', GuidesController);

GuidesController.$inject = ['$scope', '$resource'];

function GuidesController($scope, $resource) {
    $scope.guides = [];

    var Guides = $resource('/web/index_dev.php/api/guides');

    Guides.query(
        function(guides) {
            $scope.guides = guides;
        },
        function(erro) {
            console.log('it was not possible to receive the list of guides');
            console.log(erro);
        }
    );
}