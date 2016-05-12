<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use App\Provider\RepositoryServiceProvider;
use App\Controller\PatientController;
use App\Controller\GuideController;
use App\Controller\ProcedureController;
use App\Controller\AllotmentController;

date_default_timezone_set('America/Sao_Paulo');

$app = new Application();

$app->register(
    new RepositoryServiceProvider(), array(
        'repository.repositories' => array(
            'guides' => 'App\Repository\GuideRepository',
            'guides_procedures' => 'App\Repository\GuideProcedureRepository',
            'allotments' => 'App\Repository\AllotmentRepository',
            'allotments_guides' => 'App\Repository\AllotmentGuideRepository'
        )
    )
);

$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(       
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'smartris',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8'
    )
));
$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
}));


$app['guides.controller'] = $app->share(function() use ($app) {
    return new GuideController();
});

$app['patients.controller'] = $app->share(function() use ($app) {
    return new PatientController();
});

$app['procedures.controller'] = $app->share(function() use ($app) {
    return new ProcedureController();
});

$app['allotments.controller'] = $app->share(function() use ($app) {
    return new AllotmentController();
});

$app->get('/api/guides', 'guides.controller:index');
$app->get('/api/patients', 'patients.controller:index');
$app->get('/api/procedures', 'procedures.controller:index');
$app->post('/api/guides', 'guides.controller:store');
$app->post('/api/allotments', 'allotments.controller:store');


return $app;
