<?php

namespace App\Repository\Interface;

use App\Entity\Type;

interface ITypeRepository
{
    public function save(Type $Type, bool $flush = true): void;

    public function update(Type $Type);

    public function hardDelete(Type $Type);

    public function getById($value): ?Type;

    public function findAll(): array;
}
