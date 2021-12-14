<?php

namespace FileManager\Domain\Image\Entity;

interface ImageRepository
{
    public function uploadImage(string $imagePath): ?int;
    public function getImage(int $id): ?Image;
    public function deleteImage(int $id): bool;
}