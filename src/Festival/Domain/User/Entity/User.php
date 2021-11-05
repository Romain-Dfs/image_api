<?php

namespace Festival\Domain\User\Entity;

class User
{
    public function __construct(
        private string $email,
        private $role,
        private string $keycloakId
    ){}

    public function role(): string
    {
        return $this->role;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function keycloakId(): string
    {
        return $this->keycloakId;
    }
}