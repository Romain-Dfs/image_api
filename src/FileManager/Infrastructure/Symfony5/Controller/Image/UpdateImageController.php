<?php

namespace Symfony5\Controller\Image;

use FileManager\Domain\Image\UseCase\UpdateImage\UpdateImage;
use FileManager\Domain\Image\UseCase\UpdateImage\UpdateImageRequest;
use FileManager\Presentation\Image\Presenter\UpdateImageJsonPresenter;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/image/{imageId}", methods={"POST"})
 */
class UpdateImageController
{
    public function __invoke(
        int $imageId,
        Request $request,

        UpdateImage $updateImage,
        UpdateImageJsonPresenter $updateImagePresenter,
    )
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('image');

        if ( !$file ) {
            return new JsonResponse(["error" => "Aucun fichier"]);
        }

        $fileFormat = preg_match('(png|jpe?g)', $file->getClientMimeType());
        if ( !$fileFormat ) {
            return new JsonResponse(["error" => "Le format de fichier est invalide !"]);
        }

        $updateImageRequest = new UpdateImageRequest($imageId, $file->getRealPath());
        $updateImage->execute($updateImageRequest, $updateImagePresenter);

        return new JsonResponse($updateImagePresenter->viewModel());
    }
}