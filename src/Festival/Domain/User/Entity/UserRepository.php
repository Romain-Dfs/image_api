<?php

namespace Festival\Domain\User\Entity;

/**
 * La classe UserRepository est appelée par la méthode DoctrineUserRepository
 * Cette classe liste les méthodes utilisées pour réaliser des interactions avec la DB
 */
interface UserRepository
{
    /**
     * Cette fonction permet de créer un utilisateur à partir d'un accessToken
     * @return User : L'utilisateur qui vient d'ête créé
     */
    public function createUser(string $accessToken): User;

    /**
     * La fonction getUser permet de récupérer un utilisateur à l'aide de son keycloak Id
     * @param string $keycloakUserId : L'id keycloak lié à l'utilisateur
     * @return User|null : Un utilisateur qui a pour keycloakId celui passé en paramètre, sinon null
     */
    public function getUser(string $keycloakUserId): ?User;
}