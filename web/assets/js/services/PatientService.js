angular
    .module('smartris')
    .factory('PatientService', PatientService);

PatientService.$inject = ['$resource'];

function PatientService($resource) {
    return $resource('web/index_dev.php/api/patients');
}