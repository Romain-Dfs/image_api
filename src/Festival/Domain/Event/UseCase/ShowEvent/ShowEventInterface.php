<?php

namespace Festival\Domain\Event\UseCase\ShowEvent;

interface ShowEventInterface
{
   public function execute(ShowEventRequest $request, ShowEventPresenter $presenter): void;
}
