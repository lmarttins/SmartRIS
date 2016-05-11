angular
    .module('smartris', [
        'ngRoute',
        'ngResource',
        'ui.bootstrap',
        'aurbano.multiselect'
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

        $routeProvider.when('/step-1', {
            templateUrl: 'templates/partials/patients.html',
            controller: 'PatientsController'
        });

        $routeProvider.when('/step-2', {
            templateUrl: 'templates/partials/procedures.html',
            controller: 'ProceduresController'
        });

        $routeProvider.when('/step-3', {
            templateUrl: 'templates/partials/newGuide.html',
            controller: 'NewGuideController'
        });
    });