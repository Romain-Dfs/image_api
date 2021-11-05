<?php

namespace Symfony5\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Festival\Domain\User\Entity\User;
use Festival\Domain\User\Entity\UserRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony5\Doctrine\Entity\User as UserEntity;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepository
{

    public function __construct(ManagerRegistry $registry, private HttpClientInterface $client)
    {
        parent::__construct($registry, UserEntity::class);
    }

    /**
     * Cette fonction permet de créer un utilisateur à partir d'un accessToken
     * @return User : L'utilisateur qui vient d'être créé
     */
    public function createUser(string $accessToken): User
    {
        $userInfoEndpointResponse = $this->client->request('POST', 'http://172.17.0.1:28080/auth/realms/master/protocol/openid-connect/userinfo', [
            'headers' => [
                'Authorization: Bearer '.$accessToken,
                'Content-Type: application/x-www-form-urlencoded'
            ],
            'body' => [
                'client_id' => 'epsivent',
                'grant_type' => 'client_credentials',
                'client_secret' => '2cf4bf35-f29e-45c1-be0f-d4e5b77d850b',
                'scope' => 'openid'
            ]
        ]);

        $userInfoJson = json_decode($userInfoEndpointResponse->getContent());
        $userEmail = $userInfoJson->{"email"};
        $userKeycloakId = $userInfoJson->{"sub"};

        $user = new UserEntity();
        $user->setEmail($userEmail);
        $user->setRoles(['ROLE_USER']);
        $user->setKeycloakId($userKeycloakId);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);

        return new User(
            $user->getEmail(),
            $user->getRoles(),
            $user->getKeycloakId()
        );
    }

    /**
     * La fonction getUser permet de récupérer un utilisateur à l'aide de son keycloak Id
     * @param string $keycloakUserId : L'id keycloak lié à l'utilisateur
     * @return User|null : Un utilisateur qui a pour keycloakId celui passé en paramètre, sinon null
     */
    public function getUser(string $keycloakUserId): ?User
    {
        /** @var UserEntity $user */
        $user = $this->findOneBy(['keycloakId' => $keycloakUserId]);

        return $user ? new User(
            $user->getEmail(),
            $user->getRoles(),
            $user->getKeycloakId()
        ) : null;
    }
}