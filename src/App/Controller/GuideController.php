<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GuideController
{
    /**
     * Get list of guides
     *
     * @param  Application $app
     * @return JsonResponse
     */
    public function index(Application $app)
    {
        $guides = $app['guides']->findAll();

        return new JsonResponse($guides);
    }

    /**
     * Store guide
     *
     * @param  Request $request
     * @param  Application $app
     * @return JsonResponse
     */
    public function store(Request $request, Application $app)
    {
        $params = array();
        $content = $request->getContent();
        $message = array('success' => false);

        if (!empty($content)) {
            $params = json_decode($content, true);
        }

        $idGuide = $app['guides']->save(array(
            'id_patient' => $params['patient'],
            'id_provider' => $params['provider']
        ));

        $idProcedure = $app['guides_procedures']->save(array(
            'guide' => $idGuide,
            'procedures' => $params['procedures']
        ));

        if ($idGuide && $idProcedure) {
            $message = array('success' => true);
        }

        return new JsonResponse($message);
    }
}