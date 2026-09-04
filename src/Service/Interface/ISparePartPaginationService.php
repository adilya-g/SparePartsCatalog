<?php
declare(strict_types=1);
namespace App\Service\Interface;

use App\Enum\SortingType;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface ISparePartPaginationService
{
    public function paginate(int $tagId, SortingType $sortingType = SortingType::Name, string $sortingType2 = 'ASC', int $page = 1, int $perPage = 16): PaginationInterface;
}
