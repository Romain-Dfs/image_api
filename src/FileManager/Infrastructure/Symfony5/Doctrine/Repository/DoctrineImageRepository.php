<?php

namespace Symfony5\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FileManager\Domain\Image\Entity\ImageRepository;
use Symfony5\Doctrine\Entity\Image as ImageEntity;



class DoctrineImageRepository extends ServiceEntityRepository implements ImageRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageEntity::class);
    }

    public function uploadImage(string $url, string $cloudinaryId, string $format): int
    {
        $imageEntity = new ImageEntity();
        $imageEntity->setUrl($url);
        $imageEntity->setCloudinaryId($cloudinaryId);
        $imageEntity->setFormat($format);

        $this->getEntityManager()->persist($imageEntity);
        $this->getEntityManager()->flush();

        return $imageEntity->getId();
    }
}