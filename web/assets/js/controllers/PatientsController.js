angular
    .module('smartris')
    .controller('PatientsController', PatientsController);

PatientsController.$inject = ['$scope', '$resource', '$uibModal'];

function PatientsController($scope, $resource, $uibModal) {

    var vm = this;

    $scope.patients = [];
    var name = angular.element('#name');
    var cardNumber = angular.element('#card_number');
    var Patients = $resource('web/index_dev.php/api/patients');

    $scope.animationsEnabled = true;

    $scope.hello = 'hello!';

    $scope.search = function() {
        Patients.query({name: name.val(), cardNumber: cardNumber.val()},
            function(patient) {
                $scope.patients = patient;
            },
            function(error) {

            }
        );
    }
        
    $scope.open = function (id) {
        Patients.query({id: id},
            function(patient) {
                $scope.patients = patient;
            },
            function(error) {
                console.log(error);
            }
        );

        $uibModal.open({
            animation: $scope.animationsEnabled,
            templateUrl: 'patientViewModal.html',
            controller: 'ModalInstanceController',
            resolve: {
                items: function() {
                    return $scope.patients;
                }
            }
        });
    };

    $scope.toggleAnimation = function () {
        $scope.animationsEnabled = !$scope.animationsEnabled;
    };

}