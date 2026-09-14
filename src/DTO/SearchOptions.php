<?php

namespace App\DTO;

use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\Validator\Constraints as Assert;

class SearchOptions
{
    #[Assert\Length(min: 1, max: 250)]
    public ?string $searchQuery = null;
    public ?string $combineName = null;
    public ?string $typeName = null;
    public ?int $typeId = null;
    public ?array $tagIdList = null;
    public ?int $combineId = null;
    #[Assert\Choice(choices: ['ASC', 'DESC'])]
    public ?string $sortOrder = 'ASC';
    #[Assert\Choice(choices: ['date', 'price', 'name'])]
    public ?string $sortBy = 'date';

    #[Assert\Positive]
    public ?int $page = 1;
    public ?int $perPage = 12;
}
