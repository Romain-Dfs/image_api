<?php

namespace FileManager\Domain\Image\UseCase\UploadImage;

use FileManager\SharedKernel\Error\Notification;

class UploadImageResponse
{
    private ?int $imageId;
    private Notification $note;

    public function __construct()
    {
        $this->note = new Notification();
        $this->imageId = null;
    }

    public function addError(string $fieldName, string $error)
    {
        $this->note->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->note;
    }

    public function Id(): ?int
    {
        return $this->imageId;
    }

    public function setId(int $imageId): void
    {
        $this->imageId = $imageId;
    }
}