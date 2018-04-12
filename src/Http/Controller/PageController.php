<?php
declare(strict_types=1);

namespace App\Http\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="page_")
 */
class PageController extends BaseController
{
    /**
     * @Route("/", methods={"GET"})
     *
     * @return Response
     */
    public function homeAction()
    {
        return $this->json(['message' => 'Hello world!']);
    }

}