<?php

namespace FileManager\Domain\Image\UseCase\DeleteImage;

use FileManager\SharedKernel\Error\Notification;

class DeleteImageResponse
{
    private Notification $note;
    private bool $isDeleted;

    public function __construct()
    {
        $this->note = new Notification();
        $this->isDeleted = false;
    }

    public function addError(string $fieldName, string $error)
    {
        $this->note->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->note;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }


}