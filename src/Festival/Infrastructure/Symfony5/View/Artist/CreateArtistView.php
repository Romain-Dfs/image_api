<?php

namespace Symfony5\View\Artist;

use Festival\Presentation\Artist\ViewModel\CreateArtistJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateArtistView
{
    public function generateView(CreateArtistJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}