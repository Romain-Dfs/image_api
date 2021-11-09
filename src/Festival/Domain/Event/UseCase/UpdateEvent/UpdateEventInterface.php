<?php

namespace Festival\Domain\Event\UseCase\UpdateEvent;

interface UpdateEventInterface
{
   public function execute(UpdateEventRequest $request, UpdateEventPresenter $presenter): void;
}
