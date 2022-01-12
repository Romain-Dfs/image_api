<?php

namespace FileManagerTest\_Mock\Domain\Image\Entity;

use FileManager\Domain\Image\Entity\Image;
use FileManager\Domain\Image\Entity\ImageRepository;

class InMemoryImageRepository implements ImageRepository
{
    /** @var array $images */
    private $images = [];


    public function uploadImage(string $imagePath): ?int
    {
        $id = sizeof($this->images);
        $this->images[] = new Image($id, $imagePath, $imagePath, "png");

        return $id;
    }

    public function getImage(int $id): ?Image
    {
        return null;
    }

    public function deleteImage(int $id): bool
    {
        return false;
    }

    public function updateImage(int $id, string $imagePath): bool
    {
        return false;
    }
}