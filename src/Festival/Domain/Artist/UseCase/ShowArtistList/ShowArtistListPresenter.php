<?php

namespace Festival\Domain\Artist\UseCase\ShowArtistList;

interface ShowArtistListPresenter
{
   public function present(ShowArtistListResponse $response): void;
}
