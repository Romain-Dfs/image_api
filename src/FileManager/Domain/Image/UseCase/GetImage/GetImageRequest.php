<?php

namespace FileManager\Domain\Image\UseCase\GetImage;

class GetImageRequest
{
    public function __construct(
        public int $id
    ){}
}