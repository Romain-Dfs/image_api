<?php

namespace Festival\Domain\Artist\UseCase\ShowArtist;

interface ShowArtistInterface
{
   public function execute(ShowArtistRequest $request, ShowArtistPresenter $presenter): void;
}
