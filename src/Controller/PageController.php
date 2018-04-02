<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="page_")
 */
class PageController
{

    /**
     * @Route("/", methods={"GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function homeAction(Request $request)
    {
        return new Response('Home page.');
    }

}