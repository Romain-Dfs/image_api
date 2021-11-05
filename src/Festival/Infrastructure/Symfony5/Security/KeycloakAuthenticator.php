<?php

namespace Symfony5\Security;

use Festival\Domain\User\UseCase\Login\Login;
use Festival\Domain\User\UseCase\Login\LoginRequest;
use Festival\Presentation\User\Presenter\LoginJsonPresenter;
use Festival\Presentation\User\Presenter\RegisterJsonPresenter;
use Festival\Domain\User\UseCase\Register\Register;
use Festival\Domain\User\UseCase\Register\RegisterRequest;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class KeycloakAuthenticator extends OAuth2Authenticator
{

    public function __construct(
        private ClientRegistry $clientRegistry,

        private Register $register,
        private RegisterJsonPresenter $registerPresenter,

        private Login $login,
        private LoginJsonPresenter $loginPresenter
    ){}

    public function supports(Request $request): ?bool
    {
        return ('oauth_check' === $request->attributes->get('_route') );
    }

    public function authenticate(Request $request): PassportInterface
    {
//        On récupère l'access token et le refresh token de l'utilisateur
        $authEndpointResponse = $this->fetchAccessToken($this->clientRegistry->getClient('keycloak'));
        $accessToken = $authEndpointResponse->getToken();

//      On set un cookie pour récupérer l'access token actuellement
        setcookie('access_token', $accessToken, time()+300, '/', 'localhost');

        $tokenParts = explode('.', $accessToken);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);

        $keycloakUserId = $jwtPayload->{"sub"};

        $loginRequest = new LoginRequest();
        $loginRequest->keycloakUserId = $keycloakUserId;
        $this->login->execute($loginRequest, $this->loginPresenter);

        $userEmail = $this->loginPresenter->viewModel()->email;


//        Si aucun utilisateur est présent en DB
        if ( !$userEmail )
        {
            $registerRequest = new RegisterRequest();
            $registerRequest->accessToken = $accessToken;
            $this->register->execute($registerRequest, $this->registerPresenter);

            $userEmail = $this->registerPresenter->viewModel()->email;
        }

        return new SelfValidatingPassport(new UserBadge($userEmail));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $data = ['message' => 'Success'];
        return new JsonResponse($data, 200);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $failure = "Failure ! ";
        dd($failure);
    }
}