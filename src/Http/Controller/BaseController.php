<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\User\User;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class BaseController
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

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

    /**
     * @return User|null
     */
    protected function user(): ?User
    {
        return $this->tokenStorage->getToken() ? $this->tokenStorage->getToken()->getUser() : null;
    }

    /**
     * @return null|TokenInterface
     */
    protected function token(): ?TokenInterface
    {
        return $this->tokenStorage->getToken();
    }
}