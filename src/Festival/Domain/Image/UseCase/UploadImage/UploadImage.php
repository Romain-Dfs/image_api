<?php

namespace Festival\Domain\Image\UseCase\UploadImage;

use Festival\Domain\Image\Entity\ImageRepository;

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
        $newImageId = $this->repository->uploadImage($request->name);
        $response->setId($newImageId);

        // On présente la réponse en JSON
        $presenter->present($response);
    }
}