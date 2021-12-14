<?php

namespace Festival\Domain\Image\UseCase\UploadImage;

interface UploadImageInterface
{
    public function execute(UploadImageRequest $request, UploadImagePresenterInterface $presenter): void;
}