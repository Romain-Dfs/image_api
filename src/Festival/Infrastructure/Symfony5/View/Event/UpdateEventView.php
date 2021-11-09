<?php

namespace Symfony5\View\Event;

use Festival\Presentation\Event\ViewModel\UpdateEventJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateEventView
{
    public function generateView(UpdateEventJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}