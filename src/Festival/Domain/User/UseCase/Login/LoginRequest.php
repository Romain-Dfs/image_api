<?php

namespace Festival\Domain\User\UseCase\Login;

/**
 * La classe LoginRequest permet de transmettre des informations à la classe UC Login
 */
class LoginRequest
{
    /** Permet de vérifier si un utilisateur est présent en DB */
    public string $keycloakUserId;
}
