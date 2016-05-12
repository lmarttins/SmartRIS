<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProcedureController
{
    public function index(Request $request, Application $app)
    {
        $procedures = $app['db']->fetchAll('select CodTermo, Termo from TAB_18');
        
        return new JsonResponse($procedures);
    }
}