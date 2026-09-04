<?php

namespace App\Repository\Interface;

use App\Entity\SparePart;
use App\Entity\Tag;
use App\Enum\SortingType;
use Doctrine\ORM\QueryBuilder;

interface ISparePartRepository
{
    public function getQueryBuilderByTag(Tag $tag, SortingType $sortingType = SortingType::Name, string $sortingType2 = 'ASC'): \Doctrine\ORM\QueryBuilder;

    public function getById($value): ?SparePart;

    public function save(SparePart $sparePart, bool $flush = true): void;

    public function update(SparePart $sparePart): void;

    public function hardDelete(SparePart $sparePart, bool $flush = true): void;

    public function softDelete(SparePart $sparePart, bool $flush = true): void;

}
