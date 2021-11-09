<?php

namespace Festival\Domain\Artist\UseCase\CreateArtist;

interface CreateArtistInterface
{
   public function execute(CreateArtistRequest $request, CreateArtistPresenter $presenter): void;
}
