<?php

namespace Symfony5\View\Event;

use Festival\Presentation\Event\ViewModel\ShowEventListJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowEventListView
{
    public function generateView(ShowEventListJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}