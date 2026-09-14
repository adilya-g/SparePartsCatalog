<?php

namespace App\Repository\Implementation;

use App\Entity\Tag;
use App\Entity\Type;
use App\Repository\Interface\ITypeRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Type>
 */
class TypeRepository extends ServiceEntityRepository implements ITypeRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function save(Type $type, bool $flush = true): void
    {
        $this->getEntityManager()->persist($type);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(Type $type)
    {
        $this->getEntityManager()->flush();
    }

    public function hardDelete(Type $type)
    {
        $this->getEntityManager()->remove($type);
        $this->getEntityManager()->flush();
    }

    public function getById($value): ?Type
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
