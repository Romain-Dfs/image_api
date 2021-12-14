<?php

namespace Symfony5\Controller\Image;

use Festival\Domain\Image\UseCase\UploadImage\UploadImage;
use Festival\Domain\Image\UseCase\UploadImage\UploadImageRequest;
use Festival\Presentation\Image\Presenter\UploadImageJsonPresenter;
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
        $fileName = $file->getClientOriginalName();

        $uploadImageRequest = new UploadImageRequest();
        $uploadImageRequest->name = $fileName;

        $uploadImage->execute($uploadImageRequest, $uploadImagePresenter);

        return new JsonResponse($uploadImagePresenter->viewModel());
    }
}