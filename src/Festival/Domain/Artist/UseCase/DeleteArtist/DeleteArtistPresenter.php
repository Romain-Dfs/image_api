<?php

namespace Festival\Domain\Artist\UseCase\DeleteArtist;

/**
 * L'interface DeleteArtistPresenter est implémentée par la classe DeleteArtistJsonPresenter. Elle permet de faire de l'injection de dépendance
 * Cette interface contient une méthode present qui va convertir les données propre à notre code venant de notre objet DeleteArtistResponse (des objets, ...) en données
 * interprétable facilement (tableau, int, string ...)
 */
interface DeleteArtistPresenter
{
    public function present(DeleteArtistResponse $response): void;
}
