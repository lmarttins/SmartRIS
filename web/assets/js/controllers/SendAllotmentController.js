angular
    .module('smartris')
    .controller('SendAllotmentController', SendAllotmentController);

SendAllotmentController.$inject = ['$scope', 'AllotmentService', 'XmlService'];

function SendAllotmentController($scope, AllotmentService, XmlService) {
    $scope.items = [];
    $scope.selected = '';

    AllotmentService.query(
        function(allotment) {
            $scope.items = allotment;
        },
        function(error) {
            console.log(error);
        }
    );

    $scope.send = function() {
        var allotment = new XmlService({
            idAllotment: $scope.selected
        });

        XmlService.save(allotment, function(data){
            
        });
    };
}