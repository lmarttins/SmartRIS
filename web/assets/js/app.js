angular
    .module('smartris', [])
    .config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('{[%');
        $interpolateProvider.endSymbol('%]}');
    });