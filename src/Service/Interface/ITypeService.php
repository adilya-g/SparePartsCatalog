<?php

namespace App\Service\Interface;

use App\Entity\Tag;

interface ITypeService
{
    public function create(Tag $tag): bool;
    public function update(Tag $tag): bool;
    public function delete(Tag $tag): bool;
    public function getById(int $id): ?Tag;
    public function getAll(): array;
}
