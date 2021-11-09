<?php

namespace Symfony5\View\Event;

use Festival\Presentation\Event\ViewModel\CreateEventJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateEventView
{
    public function generateView(CreateEventJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}