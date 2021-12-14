<?php

namespace Symfony5\Controller\Image;

use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Cloudinary;
use FileManager\Domain\Image\UseCase\UploadImage\UploadImage;
use FileManager\Domain\Image\UseCase\UploadImage\UploadImageRequest;
use FileManager\Infrastructure\Cloudinary\CloudinaryManager;
use FileManager\Presentation\Image\Presenter\UploadImageJsonPresenter;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/image", methods={"POST"})
 */
class UploadImageController
{
    public function __invoke(
        Request $request,

        UploadImage $uploadImage,
        UploadImageJsonPresenter $uploadImagePresenter
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

        $uploadImageRequest = new UploadImageRequest($file->getRealPath());

        $uploadImage->execute($uploadImageRequest, $uploadImagePresenter);

        return new JsonResponse($uploadImagePresenter->viewModel());
    }
}