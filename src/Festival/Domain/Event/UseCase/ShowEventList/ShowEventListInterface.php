<?php

namespace Festival\Domain\Event\UseCase\ShowEventList;

interface ShowEventListInterface
{
   public function execute(ShowEventListRequest $request, ShowEventListPresenter $presenter): void;
}
