<?php
declare(strict_types=1);
namespace App\Service\Interface;

use App\DTO\SearchOptions;
use App\Enum\SortingType;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface ISparePartPaginationService
{
    public function paginate(SearchOptions $options): PaginationInterface;
}
