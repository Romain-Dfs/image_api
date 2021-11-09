<?php

namespace Symfony5\View\Artist;

use Festival\Presentation\Artist\ViewModel\ShowArtistListJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowArtistListView
{
    public function generateView(ShowArtistListJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}