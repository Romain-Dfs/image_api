<?php

namespace FileManager\Domain\Image\UseCase\DeleteImage;

interface DeleteImagePresenterInterface
{
    public function present(DeleteImageResponse $response): void;
}