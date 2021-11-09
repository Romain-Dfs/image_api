<?php

namespace Symfony5\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function PHPUnit\Framework\throwException;

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
        $accessToken = substr($request->headers->get("Authorization"), 7);
//        $accessToken = "eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJDbUo1Qmt5WmdjU25uVUY0bnpJVmtaODF2WDFBaTJaSFNqLWJ4bTd5Sm40In0.eyJleHAiOjE2MzY0NTMxNzksImlhdCI6MTYzNjQ1MzExOSwiYXV0aF90aW1lIjoxNjM2NDUxMDczLCJqdGkiOiIwMDNmNTUxMi01NjUzLTQyMTEtOTZhMS03N2Y2MjY4YjBmZWQiLCJpc3MiOiJodHRwOi8vMTcyLjE3LjAuMToyODA4MC9hdXRoL3JlYWxtcy9tYXN0ZXIiLCJhdWQiOiJhY2NvdW50Iiwic3ViIjoiZGEyMTFjM2MtNTUxNS00YzE2LWExMzAtNzQ3OWFkNzdlMzRmIiwidHlwIjoiQmVhcmVyIiwiYXpwIjoiZXBzaXZlbnQiLCJzZXNzaW9uX3N0YXRlIjoiMDRmYmExOWMtNjFkZS00MDc1LWFhMDYtNGI4ZWQ4YWJjYmZjIiwiYWNyIjoiMCIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwOi8vbG9jYWxob3N0OjgwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbImRlZmF1bHQtcm9sZXMtbWFzdGVyIiwib2ZmbGluZV9hY2Nlc3MiLCJ1bWFfYXV0aG9yaXphdGlvbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoib3BlbmlkIiwic2lkIjoiMDRmYmExOWMtNjFkZS00MDc1LWFhMDYtNGI4ZWQ4YWJjYmZjIn0.Ar5e2OwsJ2VCBUh8KDtM0dTB03JU4F77l4LKmwufljEphBG-iuIqnzQ3_tyI8Etb7EpwthoipxlcukmoTXoLJQu7R80dHbWn6hjm4Hpr_FAInMYz04GYnGaoxQBFLQOmbKsOWJ1uFRZe32KtvlN99jOX1AVwn-vvSXHDx31zhCTWyolHXPI2nfIbNIWEzPtujDdjCbPPnojFObierAuFunri_9hu9DL3hYDj3fdHVtFljjvvYqJLDGGwp9qsTYC3G2gjTBwz1TY2JRfO2EBRko0rkmSLTAjybJ93k_wXesJ-xAaxGRnSMIOZjSvV1xNIhQRFO-hPQ1zA7pGjjtfwVw";

        if ( !$accessToken ) {
            return new SelfValidatingPassport(new UserBadge(""));
        }

        $userEmail = $this->getUserInfo($accessToken);

        if ( !$userEmail ) {
            return new SelfValidatingPassport(new UserBadge(""));
        } else {
            return new SelfValidatingPassport(new UserBadge($userEmail));

        }
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // On laisse la requête continuer son chemin
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = ['message' => "Error"];
        return new JsonResponse($data, 401);
    }

    private function getUserInfo(string $accessToken): ?string
    {
        $response = $this->client->request('POST', 'http://172.17.0.1:28080/auth/realms/master/protocol/openid-connect/userinfo', [
            'headers' => [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/x-www-form-urlencoded'
            ],
            'body' => [
                'client_id' => 'epsivent',
                'grant_type' => 'client_credentials',
                'client_secret' => '2cf4bf35-f29e-45c1-be0f-d4e5b77d850b',
                'scope' => 'openid email profile'
            ]
        ]);

        try {
            $userInfoJson = json_decode($response->getContent());
        } catch (ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface | TransportExceptionInterface $e) {
            return null;
        }

        return $userInfoJson->{"email"};
    }
}