<?php
declare(strict_types=1);

namespace App\Repository\Implementation;

use App\Entity\SparePart;
use App\Entity\Tag;
use App\Enum\SortingType;
use App\Repository\Interface\ISparePartRepository;
use App\Repository\Interface\ITagRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SparePart>
 */
class SparePartRepository extends ServiceEntityRepository implements ISparePartRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SparePart::class);
    }

        /**
         * @return SparePart[] Returns an array of SparePart objects
         */
    public function getQueryBuilderByTag(Tag $tag, SortingType $sortingType = SortingType::Name, string $sortingType2 = 'ASC'): QueryBuilder
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $tag)
            ->orderBy($sortingType, $sortingType2)
        ;
    }

    public function getById($value): ?SparePart
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function save(SparePart $sparePart, bool $flush = true): void
    {
        $this->getEntityManager()->persist($sparePart);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(SparePart $sparePart): void
    {
        $this->getEntityManager()->flush();
    }

    public function hardDelete(SparePart $sparePart, bool $flush = true): void
    {
        $this->getEntityManager()->remove($sparePart);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function softDelete(SparePart $sparePart, bool $flush = true): void
    {
        $sparePart->setIsActive(false);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
