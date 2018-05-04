<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\User\UserNotFound;
use App\Domain\User\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(UserRepository $userRepository, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($tokenStorage);

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
     * @Route("/me", name="me", methods={"GET"})
     *
     * @return Response
     */
    public function meAction()
    {
        return $this->json($this->user());
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

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     *
     * @param int $id
     * @return Response
     * @throws UserNotFound
     */
    public function deleteAction(int $id)
    {
        $user = $this->userRepository->byId($id);
        $this->userRepository->delete($user);

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}