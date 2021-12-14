<?php

namespace FileManager\Infrastructure\Cloudinary;

use Cloudinary\Api\ApiResponse;
use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Cloudinary;

class CloudinaryManager
{
    private Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => 'kiwiman',
                'api_key' => '978361956771144',
                'api_secret' => '7GkTfwSUMK2WzkypQ-3wQCVaKGo'
            ],
            'url' => [
                'secure' => true
            ],
        ]);
    }

    public function deleteImage(string $imageId): void
    {
        $this->cloudinary->uploadApi()->destroy($imageId);
    }

    public function uploadImage(string $path): ?ApiResponse
    {
        /** @var ApiResponse $response */
        $response = null;
        try {
            $response = $this->cloudinary->uploadApi()->upload($path);
        } catch (ApiError $e) {
        }

        return $response;
    }
}