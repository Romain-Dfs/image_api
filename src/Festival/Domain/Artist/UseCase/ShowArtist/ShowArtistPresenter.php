<?php

namespace Festival\Domain\Artist\UseCase\ShowArtist;

interface ShowArtistPresenter
{
   public function present(ShowArtistResponse $response): void;
}
