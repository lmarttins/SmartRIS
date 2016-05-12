angular
    .module('smartris')
    .factory('GuideService', GuideService);

GuideService.$inject = ['$resource'];

function GuideService($resource) {
    return $resource('web/index_dev.php/api/guides');
}