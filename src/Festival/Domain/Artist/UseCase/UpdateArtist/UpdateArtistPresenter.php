<?php

namespace Festival\Domain\Artist\UseCase\UpdateArtist;

interface UpdateArtistPresenter
{
   public function present(UpdateArtistResponse $response): void;
}
