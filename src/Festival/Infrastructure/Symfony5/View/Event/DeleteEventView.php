<?php

namespace Symfony5\View\Event;

use Festival\Presentation\Event\ViewModel\DeleteEventJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * La classe DeleteEventView permet de générer une view qui pourra être utilisé par le client
 */
class DeleteEventView
{
    /**
     * La méthode generateView permet de générer une view JSON facilement interprétable
     * @param DeleteEventJsonViewModel $viewModel : Un ViewModel totalement interprétable
     * @return JsonResponse : Une réponse Json qui contient les données du ViewModel
     */
    public function generateView(DeleteEventJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}