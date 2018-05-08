<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\User\User;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class BaseController extends Controller
{
    use ContainerAwareTrait;

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
     * @param string[] $groups
     *
     * @return Response
     */
    protected function json($data, $status = Response::HTTP_OK, array $headers = [], array $groups = [])
    {
        $serializer = $this->container->get('jms_serializer');

        $serializationContext = SerializationContext::create()
            ->enableMaxDepthChecks()
            ->setGroups(array_merge(['Default'], $groups));

        return new JsonResponse(
            $serializer->serialize($data, 'json', $serializationContext),
            $status,
            array_merge(['Content-Type' => 'application/json'], $headers),
            true
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