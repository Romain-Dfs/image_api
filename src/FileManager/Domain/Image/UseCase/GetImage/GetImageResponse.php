<?php

namespace FileManager\Domain\Image\UseCase\GetImage;

use FileManager\Domain\Image\Entity\Image;
use FileManager\SharedKernel\Error\Notification;

class GetImageResponse
{
    private ?Image $image;
    private Notification $note;

    public function __construct()
    {
        $this->note = new Notification();
        $this->image = null;
    }

    public function addError(string $fieldName, string $error)
    {
        $this->note->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->note;
    }

    public function image(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): void
    {
        $this->image = $image;
    }


}