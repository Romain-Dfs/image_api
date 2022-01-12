<?php

namespace FileManagerTest\Domain\Image\UseCase\UploadImage;

use FileManager\Domain\Image\UseCase\UploadImage\UploadImage;
use FileManager\Domain\Image\UseCase\UploadImage\UploadImagePresenterInterface;
use FileManager\Domain\Image\UseCase\UploadImage\UploadImageRequest;
use FileManager\Domain\Image\UseCase\UploadImage\UploadImageResponse;
use FileManagerTest\_Mock\Domain\Image\Entity\InMemoryImageRepository;
use PHPUnit\Framework\TestCase;

class UploadImageTest extends TestCase implements UploadImagePresenterInterface
{

    private UploadImageResponse $response;
    private $imageRepository;
    private UploadImage $uploadImage;
    private $image1;
    private $image2;

    protected function setUp(): void
    {
        $this->imageRepository = new InMemoryImageRepository();

        $this->uploadImage = new UploadImage($this->imageRepository);
    }

    public function present(UploadImageResponse $response): void
    {
        $this->response = $response;
    }

    /**
     * Cette fonction vérifie qu'il est possible d'upload plusieurs images sans problèmes
     * On va donc regarder que le numéro de l'ID augmente de 1 entre 2 ajouts
     */
    public function test_upload_multiple_images()
    {
        $this->uploadImage->execute(new UploadImageRequest("/tmp/image1"), $this);
        $id1 = $this->response->Id();
        $this->uploadImage->execute(new UploadImageRequest("/tmp/image2"), $this);
        $id2 = $this->response->Id();

        self::assertNotEquals($id1, $id2, "Un message");
    }
}