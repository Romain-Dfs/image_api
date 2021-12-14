<?php

namespace FileManager\Domain\Image\UseCase\GetImage;

interface GetImagePresenterInterface
{
    public function present(GetImageResponse $response): void;
}