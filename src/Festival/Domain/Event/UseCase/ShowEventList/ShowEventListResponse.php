<?php

namespace Festival\Domain\Event\UseCase\ShowEventList;

class ShowEventListResponse
{
    private array $eventList;

    public function setEventList(array $eventList){
        $this->eventList = $eventList;
    }

    public function eventList(): ?array
    {
        return $this->eventList;
    }
}
