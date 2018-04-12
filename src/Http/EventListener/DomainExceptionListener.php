<?php
declare(strict_types=1);

namespace App\Http\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class DomainExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        // TODO: modify this event listener

//        $response = new JsonResponse(
//            ['errorMessage' => $exception->getMessage()],
//            Response::HTTP_INTERNAL_SERVER_ERROR
//        );
//
//        $event->setResponse($response);
    }
}