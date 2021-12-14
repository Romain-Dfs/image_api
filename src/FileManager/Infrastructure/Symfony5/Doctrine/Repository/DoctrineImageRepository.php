<?php

namespace Symfony5\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use FileManager\Domain\Image\Entity\Image;
use FileManager\Domain\Image\Entity\ImageRepository;
use FileManager\Infrastructure\Cloudinary\CloudinaryManager;
use Symfony5\Doctrine\Entity\Image as ImageEntity;



class DoctrineImageRepository extends ServiceEntityRepository implements ImageRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageEntity::class);
    }

    public function uploadImage(string $filePath): ?int
    {
        $cloudinaryManager = new CloudinaryManager();
        $data = $cloudinaryManager->uploadImage($filePath)->getArrayCopy();

        if ( $data ) {
            $imageEntity = new ImageEntity();
            $imageEntity->setUrl($data["url"]);
            $imageEntity->setCloudinaryId($data["public_id"]);
            $imageEntity->setFormat($data["format"]);

            $this->getEntityManager()->persist($imageEntity);
            $this->getEntityManager()->flush();
        }

        return $data ? $imageEntity->getId() : null;
    }

    public function getImage(int $id): ?Image
    {
        /** @var ImageEntity $imageEntity */
        $imageEntity = $this->findOneBy(["id" => $id]);

        return $imageEntity ? new Image(
            $imageEntity->getId(),
            $imageEntity->getUrl(),
            $imageEntity->getCloudinaryId(),
            $imageEntity->getFormat()
        ) : null;
    }

    public function deleteImage(int $id): bool
    {
        /** @var ImageEntity $imageEntity */
        $imageEntity = $this->findOneBy(["id" => $id]);
        $imageIsDeleted = false;

        if ( $imageEntity ) {
            try {
                $this->getEntityManager()->remove($imageEntity);
                $this->getEntityManager()->flush();

                $cloudinaryManager = new CloudinaryManager();
                $cloudinaryManager->deleteImage($imageEntity->getCloudinaryId());

                $imageIsDeleted = true;
            } catch (OptimisticLockException|ORMException $e) {
            }
        }

        return $imageIsDeleted;
    }
}