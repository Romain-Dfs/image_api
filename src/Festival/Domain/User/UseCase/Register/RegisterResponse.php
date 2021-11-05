<?php

namespace Festival\Domain\User\UseCase\Register;

use Festival\Domain\User\Entity\User;

/**
 * La classe RegisterResponse permet d'initialiser une réponse.
 * Cet objet Response va être utilisé par un RegisterPresenter pour initialiser un RegisterViewModel
 */
class RegisterResponse
{
    private User $user;

    public function setRegisteredUser(User $user): RegisterResponse
    {
        $this->user = $user;
        return $this;
    }

    public function user(): ?User
    {
        return $this->user;
    }
}
