<?php

namespace App\Repository\Interface;

use App\Entity\SparePart;
use App\Entity\Tag;

interface ITagRepository
{

    public function save(Tag $tag, bool $flush = true): void;

    public function update(Tag $tag);

    public function hardDelete(Tag $tag);

    public function getById($value): ?Tag;

}
