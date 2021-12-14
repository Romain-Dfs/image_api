<?php

namespace FileManager\Domain\Image\UseCase\DeleteImage;

use FileManager\Domain\Image\Entity\ImageRepository;

class DeleteImage implements DeleteImageInterface
{
    public function __construct(
        private ImageRepository $repository
    ){}

    public function execute(DeleteImageRequest $request, DeleteImagePresenterInterface $presenter): void
    {
        $response = new DeleteImageResponse();

        $isDeleted = $this->repository->deleteImage($request->id);

        if ( $isDeleted ) {
            $response->setIsDeleted(true);
        } else {
            $response->addError("invalid_id", "Aucune image ne correspond à l'id renseigné !");
        }

        $presenter->present($response);
    }
}