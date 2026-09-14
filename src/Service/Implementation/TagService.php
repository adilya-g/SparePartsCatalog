<?php

namespace App\Service\Implementation;

use App\Entity\Tag;
use App\Repository\Interface\ITagRepository;
use App\Service\Interface\ITagService;

class TagService implements ITagService
{
    function __construct(private readonly ITagRepository $tagRepository)
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
        return $this->tagRepository->findAll();
    }
}
