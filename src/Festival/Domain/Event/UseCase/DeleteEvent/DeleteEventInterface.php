<?php

namespace Festival\Domain\Event\UseCase\DeleteEvent;

interface DeleteEventInterface
{
   public function execute(DeleteEventRequest $request, DeleteEventPresenter $presenter): void;
}
