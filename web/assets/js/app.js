angular
    .module('smartris', [
      'ngRoute',
      'ngResource',
      'ui.bootstrap'
    ])
    .config(function($interpolateProvider, $routeProvider) {
        // Define delimiter to views
        $interpolateProvider.startSymbol('{[%');
        $interpolateProvider.endSymbol('%]}');

        // Define routes
        $routeProvider.when('/patients', {
            templateUrl: 'templates/partials/patients.html',
            controller: 'PatientsController'
        });

        $routeProvider.when('/guides', {
            templateUrl: 'templates/partials/guides.html',
            controller: 'GuidesController'
        });

        $routeProvider.when('/generate-guides', {
            templateUrl: 'templates/partials/generate_guides.html',
            controller: 'GenerateGuidesController'
        });

        $routeProvider.when('/step-1', {
            templateUrl: 'templates/partials/patients.html',
            controller: 'PatientsController'
        });
    });