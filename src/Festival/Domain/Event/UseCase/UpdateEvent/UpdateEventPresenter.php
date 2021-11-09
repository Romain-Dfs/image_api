<?php

namespace Festival\Domain\Event\UseCase\UpdateEvent;

interface UpdateEventPresenter
{
   public function present(UpdateEventResponse $response): void;
}
