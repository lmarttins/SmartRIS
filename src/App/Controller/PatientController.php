<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientController
{
    public function index(Request $request, Application $app)
    {
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
    }
}