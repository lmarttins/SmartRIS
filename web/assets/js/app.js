angular
    .module('smartris', [
        'ngRoute',
        'ngResource',
        'ui.bootstrap',
        'aurbano.multiselect',
        'LocalStorageModule'
    ])
    .config(function($interpolateProvider, $routeProvider, localStorageServiceProvider) {
        // Define delimiter to views
        $interpolateProvider.startSymbol('{[%');
        $interpolateProvider.endSymbol('%]}');

        // Define set prefix localstorage
        localStorageServiceProvider.setPrefix('smartris');

        // Define routes
        $routeProvider.when('/home', {
            templateUrl: 'templates/partials/home.html',
            controller: 'HomeController'
        });

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
            controller: 'GuidesController'
        });

        $routeProvider.when('/allotment-step-1', {
            templateUrl: 'templates/partials/allotment-step-1.html',
            controller: 'AllotmentStepOneController'
        });

        $routeProvider.when('/allotment-step-2', {
            templateUrl: 'templates/partials/allotment-step-2.html',
            controller: 'AllotmentStepTwoController'
        });

        $routeProvider.when('/send-allotment', {
            templateUrl: 'templates/partials/send-allotment.html',
            controller: 'SendAllotmentController'
        });

        $routeProvider.otherwise({redirectTo: '/home'});
    });