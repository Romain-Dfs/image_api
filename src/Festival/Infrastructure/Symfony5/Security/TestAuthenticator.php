<?php

namespace Symfony5\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TestAuthenticator extends AbstractAuthenticator
{

    public function __construct(
        private HttpClientInterface $client
    ){}

    public function supports(Request $request): ?bool
    {
        return true;
    }

    public function authenticate(Request $request): PassportInterface
    {
//        $accessToken = "eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJDbUo1Qmt5WmdjU25uVUY0bnpJVmtaODF2WDFBaTJaSFNqLWJ4bTd5Sm40In0.eyJleHAiOjE2MzU5MzY1NjAsImlhdCI6MTYzNTkzNjUwMCwiYXV0aF90aW1lIjoxNjM1OTM1OTg5LCJqdGkiOiJmYmJmYjU2Yy00ZGE3LTRmMDctOGMzYi1jZTUzZTJmOTJkOGYiLCJpc3MiOiJodHRwOi8vMTcyLjE3LjAuMToyODA4MC9hdXRoL3JlYWxtcy9tYXN0ZXIiLCJhdWQiOiJhY2NvdW50Iiwic3ViIjoiNmM1Mjk3MTAtZGRlNy00ODc1LTljODEtM2NiNDMyNjhlNWI4IiwidHlwIjoiQmVhcmVyIiwiYXpwIjoiZXBzaXZlbnQiLCJzZXNzaW9uX3N0YXRlIjoiM2Q5NThlNWEtNjRjZS00MzFjLWEyODEtNWFmZmZkYTkyOTk4IiwiYWNyIjoiMCIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwOi8vbG9jYWxob3N0OjgwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbImRlZmF1bHQtcm9sZXMtbWFzdGVyIiwib2ZmbGluZV9hY2Nlc3MiLCJ1bWFfYXV0aG9yaXphdGlvbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoib3BlbmlkIHByb2ZpbGUgZW1haWwiLCJzaWQiOiIzZDk1OGU1YS02NGNlLTQzMWMtYTI4MS01YWZmZmRhOTI5OTgiLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsIm5hbWUiOiJtYXggbWF4IiwicHJlZmVycmVkX3VzZXJuYW1lIjoibWF4IiwiZ2l2ZW5fbmFtZSI6Im1heCIsImZhbWlseV9uYW1lIjoibWF4IiwiZW1haWwiOiJtYXhAbWF4Lm1heCJ9.EKQ9EoUWLHtZdCBUKxOjHDjOw6uW6eyM9vE4GYrjnRpv25g2orWSoIwRE-XDsb_dk-1KbztVWs4fTDTzRQ7pu7gSsV6HkGVooNZmLCXPhvcyryPCJhff7_Vy2pALr6RVDMQk4mmInzK6gbr8_3GJrIy8TrBOJJOD4UyQaIH82ChHbFTcnVst77-KBQjiCIXrzae1E4Pr-ur94GtC_uVKISPgmNJl9kSA9CPUXWuVR5uSuQoz_qslf2F6diEpgxKapEceoOlgUSG5y8ymHEP4yHyQldiKn52sGEbWKjPWq0mHIBtWR9ef7_Konj0lNAMUTQnecMzl7ClJ0Za3cirOig";

        $accessToken = substr($request->headers->get("Authorization"), 7);

        if ( !$accessToken ) {
            return new SelfValidatingPassport(new UserBadge(""));
        }

        $userInfoEndpointResponse = $this->client->request('POST', 'http://172.17.0.1:28080/auth/realms/master/protocol/openid-connect/userinfo', [
            'headers' => [
                'Authorization: Bearer '.$accessToken,
                'Content-Type: application/x-www-form-urlencoded'
            ],
            'body' => [
                'client_id' => 'epsivent',
                'grant_type' => 'client_credentials',
                'client_secret' => '2cf4bf35-f29e-45c1-be0f-d4e5b77d850b',
                'scope' => 'openid email profile'
            ]
        ]);

        $userInfoJson = json_decode($userInfoEndpointResponse->getContent());
        $userEmail = $userInfoJson->{"email"};

        return new SelfValidatingPassport(new UserBadge($userEmail));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $data = ['message' => "Success"];
        return new JsonResponse($data, 200);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = ['message' => "Error"];
        return new JsonResponse($data, 401);
    }
}