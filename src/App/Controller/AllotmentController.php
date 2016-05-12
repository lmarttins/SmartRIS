<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AllotmentController
{
    /**
     * Get list of allotments
     *
     * @param  Application $app
     * @return JsonResponse
     */
    public function index(Application $app)
    {
        $allotments = $app['allotments']->findAll();

        return new JsonResponse($allotments);
    }

    /**
     * Store allotment
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

        $allotmentLastId = $app['allotments']->save();
        $app['allotments_guides']->save(array(
            'allotment' => $allotmentLastId,
            'guides' => $params['guides']
        ));

        if ($allotmentLastId) {
            $message = array('success' => true);
        }

        return new JsonResponse($message);
    }
}