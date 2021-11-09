<?php

namespace Festival\Domain\Event\UseCase\CreateEvent;

interface CreateEventPresenter
{
   public function present(CreateEventResponse $response): void;
}
