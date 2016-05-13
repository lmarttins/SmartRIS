angular
    .module('smartris')
    .factory('XmlService', XmlService);

XmlService.$inject = ['$resource'];

function XmlService($resource) {
    return $resource('web/index_dev.php/api/xml');
}