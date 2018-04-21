<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\User\UserNotFound;
use App\Domain\User\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("")
 */
class AuthController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var JWTManager
     */
    private $jwt;

    /**
     * @param UserRepository $userRepository
     * @param JWTManager $jwt
     */
    public function __construct(UserRepository $userRepository, JWTManager $jwt)
    {
        $this->userRepository = $userRepository;
        $this->jwt = $jwt;
    }

    /**
     * @Route("/login", name="login", methods={"POST"})
     *
     * @return Response
     * @throws UserNotFound
     */
    public function loginAction()
    {
        $user = $this->userRepository->byId(1);

        return $this->json(['token' => $this->jwt->create($user)]);
    }
}