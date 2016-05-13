<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Service\GenerateXml;

class XmlController
{
    public function store(Application $app, Request $request)
    {
        $params = array();
        $content = $request->getContent();
        $message = array('success' => false);

        if (!empty($content)) {
            $params = json_decode($content, true);
        }

        $xml = new GenerateXml();
        $xml->setData($app['xml']->findByLot((int) $params['idAllotment']));

        if ($xml->save($params['idAllotment'])) {
            $message = array('success' => true);
        }

        return new JsonResponse($message);
    }
}