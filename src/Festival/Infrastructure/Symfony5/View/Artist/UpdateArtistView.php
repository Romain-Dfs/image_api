<?php

namespace Symfony5\View\Artist;

use Festival\Presentation\Artist\ViewModel\UpdateArtistJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateArtistView
{
    public function generateView(UpdateArtistJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}