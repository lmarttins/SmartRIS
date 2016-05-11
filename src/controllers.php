<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array());
})
->bind('homepage')
;

$app->get('/api/patients/', function (Request $request) use ($app) {

    $params = $request->query->all();

    $sql = "
    select id_card_number, name from patients
    where name like '%{$params['name']}%'
    ";

    $patients = $app['db']->fetchAll($sql);

    return new JsonResponse($patients);
});

$app->get('/api/guides/', function () use ($app) {
    $guides = $app['db']->fetchAssoc('select * from guides');
    return new JsonResponse(array($guides));
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
