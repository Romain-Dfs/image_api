<?php

namespace FileManager\Domain\Image\Entity;

interface ImageRepository
{
    public function uploadImage(string $url, string $cloudinaryId, string $format): int;
}