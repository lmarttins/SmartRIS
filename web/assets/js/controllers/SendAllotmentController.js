angular
    .module('smartris')
    .controller('SendAllotmentController', SendAllotmentController);

SendAllotmentController.$inject = ['$scope', 'AllotmentService', 'XmlService'];

function SendAllotmentController($scope, AllotmentService, XmlService) {
    var vm = this;
    $scope.items = [];
    $scope.selected = '';
    vm.alertSuccess = false;

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
            if (data.success) {
                vm.alertSuccess = true;
            }
        });
    };
}