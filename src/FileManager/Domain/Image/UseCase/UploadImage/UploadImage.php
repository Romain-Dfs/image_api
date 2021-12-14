<?php

namespace FileManager\Domain\Image\UseCase\UploadImage;

use FileManager\Domain\Image\Entity\ImageRepository;

class UploadImage implements UploadImageInterface
{
    public function __construct(
        private ImageRepository $repository
    ){}

    public function execute(UploadImageRequest $request, UploadImagePresenterInterface $presenter): void
    {
        // On initialise un objet response qu'on passera au présenter
        $response = new UploadImageResponse();

        // On sauvegarde l'image en DB
        $newImageId = $this->repository->uploadImage($request->filePath);

        if ( $newImageId ) {
            $response->setId($newImageId);
        } else {
            $response->addError("upload_failed", "Une erreur est survenue lors de la sauvegarde de l'image en DB !");
        }

        // On présente la réponse en JSON
        $presenter->present($response);
    }
}