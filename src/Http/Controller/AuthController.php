<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\User\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\PreAuthenticationJWTUserToken;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Guard\AuthenticatorInterface;

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
     * @var JWTTokenManagerInterface
     */
    private $jwt;

    /**
     * @var PreAuthenticationJWTUserToken
     */
    private $authenticator;

    /**
     * @param UserRepository $userRepository
     * @param JWTTokenManagerInterface $jwt
     * @param PreAuthenticationJWTUserToken $authenticator
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        UserRepository $userRepository,
        JWTTokenManagerInterface $jwt,
        PreAuthenticationJWTUserToken $authenticator,
        TokenStorageInterface $tokenStorage
    ) {
        parent::__construct($tokenStorage);

        $this->jwt = $jwt;
        $this->userRepository = $userRepository;
        $this->authenticator = $authenticator;
    }

    /**
     * @Route("/token", name="token", methods={"POST"})
     */
    public function loginAction()
    {
        return $this->json(null, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @Route("/token/refresh", name="refresh", methods={"GET"})
     * @param Request $request
     *
     * @return Response
     */
    public function refreshAction(Request $request)
    {
//        dump($this->jwt->decode($this->token()));exit;
        $preAuthToken = $this->authenticator->getCredentials();
        dump($preAuthToken);exit;

        $user = $this->userRepository
            ->byEmail($request->getUser());

        if (!$user) {
            throw $this->createNotFoundException();
        }

        if (!$this->get('security.password_encoder')->isPasswordValid($user, $request->getPassword())) {
            throw new BadCredentialsException();
        }

        $token = $this->get('lexik_jwt_authentication.encoder')->encode(['username' => $user->getUsername()]);

        return $this->json(['token' => $token]);
    }
}