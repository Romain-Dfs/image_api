<?php

namespace Festival\Domain\Artist\UseCase\DeleteArtist;

/**
 * Notre classe DeleteArtistRequest permet de faire transiter des informations d'une classe controller jusqu'à notre UC DeleteArtist 
 */
class DeleteArtistRequest
{
    public int $artistId;
}
