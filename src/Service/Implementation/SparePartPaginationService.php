<?php

namespace App\Service\Implementation;

use App\DTO\SearchOptions;
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

    public function paginate(SearchOptions $options): PaginationInterface
    {
        $queryBuilder = $this->sparePartRepository->getQueryBuilder($options);
        return $this->paginator->paginate($queryBuilder, $options->page, $options->perPage);
    }
}
