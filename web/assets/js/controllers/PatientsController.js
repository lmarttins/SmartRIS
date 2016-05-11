angular
    .module('smartris')
    .controller('PatientsController', PatientsController);

PatientsController.$inject = ['$scope', '$resource'];

function PatientsController($scope, $resource) {

    var name = angular.element('#name');
    var cardNumber = angular.element('#card_number');

    $scope.patients = [];

    $scope.search = function() {
        var Patients = $resource('web/index_dev.php/api/patients');

        Patients.query({name: name.val()},
            function(patient) {
                $scope.patients = patient;
            },
            function(error) {

            }
        );
    }
}