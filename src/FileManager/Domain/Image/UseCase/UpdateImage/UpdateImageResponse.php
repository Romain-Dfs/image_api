<?php

namespace FileManager\Domain\Image\UseCase\UpdateImage;

use FileManager\Domain\Image\Entity\Image;
use FileManager\SharedKernel\Error\Notification;

class UpdateImageResponse
{
    private bool $isUpdate;
    private Notification $note;

    public function __construct()
    {
        $this->note = new Notification();
        $this->isUpdate = false;
    }

    public function addError(string $fieldName, string $error)
    {
        $this->note->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->note;
    }

    public function isUpdate(): bool
    {
        return $this->isUpdate;
    }

    public function setIsUpdate(bool $isUpdate): void
    {
        $this->isUpdate = $isUpdate;
    }


}