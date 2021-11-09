<?php

namespace Festival\Domain\Artist\UseCase\ShowArtistList;

interface ShowArtistListInterface
{
   public function execute(ShowArtistListRequest $request, ShowArtistListPresenter $presenter): void;
}
