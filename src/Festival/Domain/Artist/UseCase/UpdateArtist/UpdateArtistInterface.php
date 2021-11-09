<?php

namespace Festival\Domain\Artist\UseCase\UpdateArtist;

interface UpdateArtistInterface
{
   public function execute(UpdateArtistRequest $request, UpdateArtistPresenter $presenter): void;
}
