<?php

namespace Festival\Domain\Artist\Entity;

interface ArtistRepository
{
    public function createArtist(Artist $artist): void;
    public function getArtistList(): array;
    public function getArtist(int $artistId): ?Artist;
    public function updateArtist(Artist $artist): ?Artist;
    public function deleteArtist(int $artistId): void;
}