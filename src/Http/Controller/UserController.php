<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\User\UserNotFound;
use App\Domain\User\UserRepository;
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

    /**
     * @Route("/{id}", name="byId", methods={"GET"})
     *
     * @param int $id
     * @return Response
     * @throws UserNotFound
     */
    public function byIdAction(int $id)
    {
        return $this->json($this->userRepository->byId($id));
    }
}