<?php

namespace App\Repository\Implementation;

use App\Entity\Combine;
use App\Repository\Interface\ICombineRepository;
use App\Repository\Interface\ITagRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Combine>
 */
class CombineRepository extends ServiceEntityRepository implements ICombineRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Combine::class);
    }

        /**
         * @return Combine[] Returns an array of Combine objects
         */
        public function save(Combine $combine, bool $flush = true): Combine
        {
            $this->getEntityManager()->persist($combine);
            if ($flush) {
                $this->getEntityManager()->flush();
            }
            return $combine;
        }

        public function update(Combine $combine)
        {
            $this->getEntityManager()->flush();
        }

        public function softDelete(Combine $combine)
        {
            $combine->setIsActive(false);
            $this->getEntityManager()->flush();
        }

        public function hardDelete(Combine $combine)
        {
            $this->getEntityManager()->remove($combine);
            $this->getEntityManager()->flush();
        }
        public function getById($value): ?Combine
        {
            return $this->createQueryBuilder('c')
                ->andWhere('c.id = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
}
