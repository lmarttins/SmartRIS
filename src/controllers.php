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
    $where = '';

    if (isset($params['id']) && !empty($params['id'])) {
        $where .= "id = {$params['id']} AND ";
    }

    if (isset($params['name']) && !empty($params['name'])) {
        $where .= "name like '%{$params['name']}%' AND ";
    }

    if (isset($params['cardNumber']) && !empty($params['cardNumber'])) {
        $where .= "id_card_number = {$params['cardNumber']} AND ";
    }

    $where = rtrim($where, 'AND ');

    $sql = "select id, id_card_number, name from patients where $where";

    $patients = $app['db']->fetchAll($sql);

    return new JsonResponse($patients);
});

$app->get('/api/procedures/', function () use ($app) {
    $procedures = $app['db']->fetchAll('select CodTermo, Termo from TAB_18');
    return new JsonResponse($procedures);
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
