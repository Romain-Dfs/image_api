<?php

namespace FileManager\Domain\Image\UseCase\DeleteImage;

class DeleteImageRequest
{
    public function __construct(
        public int $id
    ){}
}