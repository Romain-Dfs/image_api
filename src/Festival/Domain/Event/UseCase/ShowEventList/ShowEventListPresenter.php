<?php

namespace Festival\Domain\Event\UseCase\ShowEventList;

interface ShowEventListPresenter
{
   public function present(ShowEventListResponse $response): void;
}
