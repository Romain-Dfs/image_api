<?php

namespace Symfony5\Controller\Image;

use FileManager\Domain\Image\UseCase\GetImage\GetImage;
use FileManager\Domain\Image\UseCase\GetImage\GetImageRequest;
use FileManager\Presentation\Image\Presenter\GetImageJsonPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/image/{imageId}", methods={"GET"})
 */
class GetImageController
{
    public function __invoke(
        int $imageId,

        GetImage $getImage,
        GetImageJsonPresenter $getImagePresenter
    )
    {
        $getImageRequest = new GetImageRequest($imageId);
        $getImage->execute($getImageRequest, $getImagePresenter);

        return new JsonResponse($getImagePresenter->viewModel());
    }
}