<?php

namespace Festival\Domain\Image\Entity;

interface ImageRepository
{
    public function uploadImage(string $name): int;
}