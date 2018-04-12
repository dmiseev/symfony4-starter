<?php
declare(strict_types=1);

namespace App\Http\Controller;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;

class BaseController
{
    /**
     * @param $data
     * @param int $status
     * @param array $headers
     * @param array $groups
     *
     * @return Response
     */
    protected function json($data, $status = Response::HTTP_OK, array $headers = [], array $groups = [])
    {
        $serializer = SerializerBuilder::create()->build();

//        if ($data instanceof LengthAwarePaginator) {
//            $totalItems = $data->total();
//            $data = $data->items();
//        }

        return new Response(
            $serializer->serialize($data, 'json', SerializationContext::create()->setGroups(
                array_merge(['Default'], $groups)
            )),
            $status,
            array_merge([
                'Content-Type' => 'application/json',
                'X-Items-Count' => count($data)
            ], $headers)
        );
    }
}