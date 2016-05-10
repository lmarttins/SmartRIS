angular
    .module('smartris')
    .controller('PatientsController', PatientsController);

PatientsController.$inject = ['$scope', '$resource'];

function PatientsController($scope, $resource) {

    var patients = [];

    $scope.findPatients = function(value) {
        var Patients = $resource('/web/index_dev.php/api/patients/:name', {name: value})
        Patients.query(
            function(patient) {
                patients = patient.map(function(item){
                    return item.name;
                });
            },
            function(error) {
                console.log('it was not possible to receive the list of patients');
                console.log(error);
            }
        )
        return patients;
    };
}