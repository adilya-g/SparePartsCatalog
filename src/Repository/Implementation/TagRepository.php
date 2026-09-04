<?php

namespace App\Repository\Implementation;

use App\Entity\Combine;
use App\Entity\SparePart;
use App\Entity\Tag;
use App\Repository\Interface\ITagRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tag>
 */
class TagRepository extends ServiceEntityRepository implements ITagRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function save(Tag $tag, bool $flush = true): void
    {
        $this->getEntityManager()->persist($tag);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(Tag $tag)
    {
        $this->getEntityManager()->flush();
    }

    public function hardDelete(Tag $tag)
    {
        foreach ($tag->getSpareParts() as $sparePart) {
            $sparePart->removeTag($tag);
        }
        $this->getEntityManager()->remove($tag);
        $this->getEntityManager()->flush();
    }

    public function getById($value): ?Tag
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
