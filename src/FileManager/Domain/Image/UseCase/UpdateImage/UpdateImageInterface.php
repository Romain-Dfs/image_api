<?php

namespace FileManager\Domain\Image\UseCase\UpdateImage;

use FileManager\Domain\Image\UseCase\UploadImage\UploadImageRequest;

interface UpdateImageInterface
{
    public function execute(UpdateImageRequest $request, UpdateImagePresenterInterface $presenter): void;
}