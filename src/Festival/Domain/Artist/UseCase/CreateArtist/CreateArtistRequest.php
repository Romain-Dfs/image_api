<?php

namespace Festival\Domain\Artist\UseCase\CreateArtist;

/**
 * La requête de l'UC CreateArtist va récupérer les informations nécessaires à la logique métier
 */
class CreateArtistRequest
{
    // Le nom de l'artiste
    public ?string $name;

    // La description de l'artiste
    public ?string $description;
}
