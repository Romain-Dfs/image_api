<?php

namespace FileManager\Domain\Image\UseCase\GetImage;

use FileManager\Domain\Image\Entity\ImageRepository;

class GetImage implements GetImageInterface
{
    public function __construct(
        private ImageRepository $repository
    ){}

    public function execute(GetImageRequest $request, GetImagePresenterInterface $presenter): void
    {
        $response = new GetImageResponse();

        $image = $this->repository->getImage($request->id);

        if ( $image ) {
            $response->setImage($image);
        } else {
            $response->addError("invalid_id", "Aucune image ne correspond à l'id renseigné");
        }

        $presenter->present($response);
    }
}