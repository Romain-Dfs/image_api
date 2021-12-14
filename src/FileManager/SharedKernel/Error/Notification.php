<?php

namespace FileManager\SharedKernel\Error;

use FileManager\SharedKernel\Error\Error;

class Notification
{
    private array $errors = [];

    public function addError(string $fieldName, string $error): Notification
    {
        $this->errors[] = new Error($fieldName, $error);

        return $this;
    }

    /**
     * @return Error[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasError(): bool
    {
        return count($this->errors) > 0;
    }
}