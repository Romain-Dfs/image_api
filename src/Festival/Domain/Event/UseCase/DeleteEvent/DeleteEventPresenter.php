<?php

namespace Festival\Domain\Event\UseCase\DeleteEvent;

interface DeleteEventPresenter
{
   public function present(DeleteEventResponse $response): void;
}
