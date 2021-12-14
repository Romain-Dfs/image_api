<?php

namespace FileManager\Domain\Image\UseCase\UploadImage;

class UploadImageRequest
{
    public function __construct(
        public string $url,
        public string $cloudinaryId,
        public string $format
    ){}
}