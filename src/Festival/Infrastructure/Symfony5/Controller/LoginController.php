<?php

namespace Symfony5\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/login", name="login")
 */
class LoginController
{
    public function __invoke(ClientRegistry $clientRegistry)
    {
        $client = $clientRegistry->getClient('keycloak');
        return $client->redirect(['openid', 'profile', 'email']);
    }
}