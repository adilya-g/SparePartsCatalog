<?php
declare(strict_types=1);

namespace App\Repository\Implementation;

use App\DTO\SearchOptions;
use App\Entity\SparePart;
use App\Entity\Tag;
use App\Enum\SortingType;
use App\Repository\Interface\ISparePartRepository;
use App\Repository\Interface\ITagRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @extends ServiceEntityRepository<SparePart>
 */
class SparePartRepository extends ServiceEntityRepository implements ISparePartRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly LoggerInterface $logger,
    )
    {
        parent::__construct($registry, SparePart::class);
    }

        /**
         * @return SparePart[] Returns an array of SparePart objects
         */
    public function getQueryBuilder(SearchOptions $options): QueryBuilder
    {
        $this->logger->debug('Getting search query', ['searchOptions' => $options]);
        $queryBuilder = $this->createQueryBuilder('s');

        if ($options->searchQuery !== null) {
            $queryBuilder->andWhere(
                's.name LIKE :searchQuery OR s.articleNumber LIKE :searchQuery'
            )
                ->setParameter('searchQuery', '%' . $options->searchQuery . '%');
        }

        if ($options->tagId !== null) {
            $queryBuilder->innerJoin('s.tags', 't')
                ->andWhere('t.id = :tagId')
                ->setParameter('tagId', $options->tagId);
        }

        $allowedSortFields = ['date' => 's.createdAt', 'price' => 's.price', 'name' => 's.name'];
        $sortField = $allowedSortFields[$options->sortBy] ?? 's.createdAt';

        $allowedOrders = ['ASC', 'DESC'];
        $sortOrder = in_array(strtoupper($options->sortOrder), $allowedOrders)
            ? strtoupper($options->sortOrder)
            : 'ASC';

        $queryBuilder->orderBy($sortField, $sortOrder);

        return $queryBuilder;
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
