<?php

namespace App\Repository\Interface;

use App\DTO\SearchOptions;
use App\Entity\SparePart;
use App\Entity\Tag;
use App\Enum\SortingType;
use Doctrine\ORM\QueryBuilder;

interface ISparePartRepository
{
    public function getQueryBuilder(SearchOptions $options): \Doctrine\ORM\QueryBuilder;

    public function getById($value): ?SparePart;

    public function save(SparePart $sparePart, bool $flush = true): void;

    public function update(SparePart $sparePart): void;

    public function hardDelete(SparePart $sparePart, bool $flush = true): void;

    public function softDelete(SparePart $sparePart, bool $flush = true): void;

}
