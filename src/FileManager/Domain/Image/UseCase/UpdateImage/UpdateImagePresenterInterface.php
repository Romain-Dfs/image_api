<?php

namespace FileManager\Domain\Image\UseCase\UpdateImage;

interface UpdateImagePresenterInterface
{
    public function present(UpdateImageResponse $response): void;
}