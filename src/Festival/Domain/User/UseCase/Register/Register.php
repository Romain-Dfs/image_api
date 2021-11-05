<?php

namespace Festival\Domain\User\UseCase\Register;

use Festival\Domain\User\Entity\UserRepository;

class Register implements RegisterInterface
{

   public function __construct(
       private UserRepository $userRepository
   ){}

    public function execute(RegisterRequest $request, RegisterPresenter $presenter): void
    {
        $response = new RegisterResponse();
        $newUser = $this->userRepository->createUser($request->accessToken);

        $response->setRegisteredUser($newUser);
        $presenter->present($response);
    }
}
