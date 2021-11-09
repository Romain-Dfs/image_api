<?php

namespace Symfony5\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Festival\Domain\Artist\Entity\Artist;
use Festival\Domain\Artist\Entity\ArtistRepository;
use Symfony5\Doctrine\Entity\Artist as ArtistEntity;

class DoctrineArtistRepository extends ServiceEntityRepository implements ArtistRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtistEntity::class);
    }

    /**
     * La méthode createArtist permet d'ajouter un nouvel artist en DB
     * @param Artist $artist : L'artiste à ajouter en DB
     */
    public function createArtist(Artist $artist): void
    {
        $artistEntity = new ArtistEntity();
        $artistEntity->setName($artist->name());
        $artistEntity->setDescription($artist->description());

        $this->getEntityManager()->persist($artistEntity);
        $this->getEntityManager()->flush();
    }

    public function getArtistList(): array
    {
        $artistList = $this->findBy([], array('id' => 'ASC'));

        return array_map(
            function (ArtistEntity $artist){
                return new Artist($artist->getName(), $artist->getDescription());
            }, $artistList
        );
    }

    public function getArtist(int $artistId): ?Artist
    {
        /** @var ArtistEntity $artist */
        $artist = $this->findOneBy(['id' => $artistId]);

        return $artist ? new Artist(
            $artist->getName(),
            $artist->getDescription()
        ): null;
    }

    /**
     * Cette méthode permet de mettre à jour un artiste
     *
     * Si l'id de l'artiste passé en paramètre correspond à un artiste en DB, alors on maj celui en DB en fonction de celui en paramètre
     * Sinon, cela signifie que les données passées lors de la requête sont fausses, donc on retourne null
     */
    public function updateArtist(Artist $artist): ?Artist
    {
        /** @var ArtistEntity $updatedArtist */
        $updatedArtist = $this->findOneBy(['id' => $artist->id()]);

        if ( $updatedArtist )
        {
            $updatedArtist->setName($artist->name());
            $updatedArtist->setDescription($artist->description());
            $this->getEntityManager()->persist($updatedArtist);
            $this->getEntityManager()->flush($updatedArtist);

            return new Artist(
                $updatedArtist->getName(),
                $updatedArtist->getDescription()
            );
        }

        return null;
    }

    public function deleteArtist(int $artistId): void
    {
        /** @var ArtistEntity $artist */
        $artist = $this->findOneBy(['id' => $artistId]);
        $this->getEntityManager()->remove($artist);
        $this->getEntityManager()->flush();
    }
}