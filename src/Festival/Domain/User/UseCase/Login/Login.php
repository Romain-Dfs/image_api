<?php

namespace Festival\Domain\User\UseCase\Login;

use Festival\Domain\User\Entity\UserRepository;

/**
 * La classe Login va permettre de définir si un utilisateur est présent en DB à l'aide de son keycloak ID
 * Si oui, on log l'utilisateur, sinon, on le register
 */
class Login implements LoginInterface
{

    public function __construct(
        private UserRepository $userRepository
    ){}

    public function execute(LoginRequest $request, LoginPresenter $presenter): void
    {
       $response = new LoginResponse();
       $user = $this->userRepository->getUser($request->keycloakUserId);

       $response->setLoginUser($user);
       $presenter->present($response);
    }
}
