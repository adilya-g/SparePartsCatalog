<?php

namespace App\Service\Interface;

use App\Entity\SparePart;
use App\Entity\Tag;

interface ISparePartService
{
    public function create(SparePart $part): bool;
    public function update(SparePart $part): bool;
    public function delete(SparePart $part): bool;
    public function getById(int $id): ?SparePart;
}
