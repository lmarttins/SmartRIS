angular
    .module('smartris')
    .controller('PatientsController', PatientsController);

PatientsController.$inject = ['$scope', 'PatientService', '$uibModal'];

function PatientsController($scope, PatientService, $uibModal) {

    $scope.patients = [];
    var name = angular.element('#name');
    var cardNumber = angular.element('#card_number');

    $scope.animationsEnabled = true;

    $scope.search = function() {
        PatientService.query({name: name.val(), cardNumber: cardNumber.val()},
            function(patient) {
                $scope.patients = patient;
            },
            function(error) {

            }
        );
    }
        
    $scope.open = function (id) {
        PatientService.query({id: id},
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