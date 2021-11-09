<?php

namespace Festival\Domain\Event\UseCase\CreateEvent;

interface CreateEventInterface
{
   public function execute(CreateEventRequest $request, CreateEventPresenter $presenter): void;
}
