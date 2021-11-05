<?php

namespace Festival\Domain\User\UseCase\Login;

use Festival\Domain\User\Entity\User;

class LoginResponse
{
    private ?User $user;

    public function setLoginUser(?User $user): LoginResponse
    {
        $this->user = $user;
        return $this;
    }

    public function user(): ?User
    {
        return $this->user;
    }
}
