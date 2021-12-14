<?php

namespace FileManager\Domain\Image\UseCase\UpdateImage;

class UpdateImageRequest
{
    public function __construct(
        public int $id,
        public string $filePath,
    ){}
}