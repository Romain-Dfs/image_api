<?php

namespace Symfony5\View\Event;

use Festival\Presentation\Event\ViewModel\ShowEventJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowEventView
{
    public function generateView(ShowEventJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}