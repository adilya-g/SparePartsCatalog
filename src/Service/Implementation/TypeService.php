<?php

namespace App\Service\Implementation;

use App\Entity\Tag;
use App\Repository\Interface\ITypeRepository;
use App\Service\Interface\ITypeService;

class TypeService implements ITypeService
{
    function __construct(private readonly ITypeRepository $typeRepository)
    {

    }

    public function create(Tag $tag): bool
    {
        // TODO: Implement create() method.
    }

    public function update(Tag $tag): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(Tag $tag): bool
    {
        // TODO: Implement delete() method.
    }

    public function getById(int $id): ?Tag
    {
        // TODO: Implement getById() method.
    }

    public function getAll(): array
    {
        return $this->typeRepository->findAll();
    }
}
