<?php

namespace Festival\Domain\Artist\UseCase\CreateArtist;

interface CreateArtistPresenter
{
   public function present(CreateArtistResponse $response): void;
}
