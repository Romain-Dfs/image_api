<?php

namespace Festival\Domain\Image\UseCase\UploadImage;

interface UploadImagePresenterInterface
{
 public function present(UploadImageResponse $response): void;
}