<?php

namespace FileManager\Domain\Image\UseCase\GetImage;

interface GetImageInterface
{
    public function execute(GetImageRequest $request, GetImagePresenterInterface $presenter): void;
}