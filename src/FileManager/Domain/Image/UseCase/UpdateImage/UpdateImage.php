<?php

namespace FileManager\Domain\Image\UseCase\UpdateImage;

use FileManager\Domain\Image\Entity\ImageRepository;

class UpdateImage implements UpdateImageInterface
{
    public function __construct(
        private ImageRepository $repository,
    ){}

    public function execute(UpdateImageRequest $request, UpdateImagePresenterInterface $presenter): void
    {
        $response = new UpdateImageResponse();


        $isUpdate = $this->repository->updateImage($request->id, $request->filePath);

        if ( $isUpdate ) {
            $response->setIsUpdate(true);
        } else {
            $response->addError("update_failed", "L'id ne correspond à aucun élément en base de données !");
        }

        $presenter->present($response);
    }
}