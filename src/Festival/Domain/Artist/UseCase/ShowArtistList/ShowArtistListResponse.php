<?php

namespace Festival\Domain\Artist\UseCase\ShowArtistList;

use Festival\Domain\Artist\Entity\Artist;

class ShowArtistListResponse
{
    private ?array $artistList;

    public function setArtistList(array $artistList){
        $this->artistList = $artistList;
    }

    public function artistList(): ?array
    {
        return $this->artistList;
    }
}
