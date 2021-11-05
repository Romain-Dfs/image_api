<?php

namespace Festival\Domain\User\UseCase\Register;

/**
 * La classe RegisterRequest récupère un accessToken qu'il va transmettre à la classe Register
 */
class RegisterRequest
{
//     Cet access token va permettre de récupérer des informations sur l'utilisateur depuis le UserInfo Endpoint
    public $accessToken;
}
