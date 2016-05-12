angular
    .module('smartris')
    .factory('ProcedureService', ProcedureService);

ProcedureService.$inject = ['$resource'];

function ProcedureService($resource) {
    return $resource('web/index_dev.php/api/procedures');
}