<?php

namespace Festival\Domain\Image\UseCase\UploadImage;

class UploadImageResponse
{
    private int $imageId;

    /**
     * @return int
     */
    public function Id(): int
    {
        return $this->imageId;
    }

    /**
     * @param int $imageId
     */
    public function setId(int $imageId): void
    {
        $this->imageId = $imageId;
    }
}