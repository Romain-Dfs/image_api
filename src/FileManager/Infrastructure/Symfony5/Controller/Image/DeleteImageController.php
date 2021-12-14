<?php

namespace Symfony5\Controller\Image;

use Cloudinary\Cloudinary;
use FileManager\Domain\Image\UseCase\DeleteImage\DeleteImage;
use FileManager\Domain\Image\UseCase\DeleteImage\DeleteImageRequest;
use FileManager\Infrastructure\Cloudinary\CloudinaryManager;
use FileManager\Presentation\Image\Presenter\DeleteImageJsonPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/image/{imageId}", methods={"DELETE"})
 */
class DeleteImageController
{
    public function __invoke(
        int $imageId,

        DeleteImage $deleteImage,
        DeleteImageJsonPresenter $presenter,
    )
    {
        $deleteImageRequest = new DeleteImageRequest($imageId);
        $deleteImage->execute($deleteImageRequest, $presenter);

        return new JsonResponse($presenter->viewModel());
    }
}