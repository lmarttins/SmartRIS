angular
    .module('smartris')
    .factory('AllotmentService', AllotmentService);

AllotmentService.$inject = ['$resource'];

function AllotmentService($resource) {
    return $resource('web/index_dev.php/api/guides');
}