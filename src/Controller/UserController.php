<?php
declare(strict_types=1);

namespace App\Controller;

use App\Domian\User\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users", name="users_")
 */
class UserController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("", name="all", methods={"GET"})
     *
     * @return Response
     */
    public function allAction()
    {
        return $this->json($this->userRepository->all());
    }

}