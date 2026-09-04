<?php

namespace App\Service\Implementation;

use App\Enum\SortingType;
use App\Repository\Interface\ISparePartRepository;
use App\Repository\Interface\ITagRepository;
use App\Service\Interface\ISparePartPaginationService;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class SparePartPaginationService implements ISparePartPaginationService
{
    function __construct(private readonly ISparePartRepository $sparePartRepository,
    private readonly ITagRepository $tagRepository,
    private readonly PaginatorInterface $paginator)
    {

    }

    public function paginate(int $tagId, SortingType $sortingType = SortingType::Name, string $sortingType2 = 'ASC', int $page = 1, int $perPage = 16): PaginationInterface
    {
        $tag = $this->tagRepository->getById($tagId);
        $queryBuilder = $this->sparePartRepository->getQueryBuilderByTag($tag, $sortingType, $sortingType2);
        return $this->paginator->paginate($queryBuilder, $page, $perPage);
    }
}
