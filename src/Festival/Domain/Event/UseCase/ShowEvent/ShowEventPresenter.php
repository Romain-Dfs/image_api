<?php

namespace Festival\Domain\Event\UseCase\ShowEvent;

interface ShowEventPresenter
{
   public function present(ShowEventResponse $response): void;
}
