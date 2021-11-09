<?php

namespace Symfony5\View\Artist;

use Festival\Presentation\User\ViewModel\ShowArtistJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowArtistView
{
    public function generateView(ShowArtistJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}