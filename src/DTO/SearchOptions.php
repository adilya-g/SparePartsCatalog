<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class SearchOptions
{
    #[Assert\Length(min: 1, max: 250)]
    public string $searchQuery;
    public int $tagId;
    #[Assert\Choice(choices: ['ASC', 'DESC'])]
    public string $sortOrder;
    #[Assert\Choice(choices: ['date', 'price', 'name'])]
    public string $sortBy = 'date';

    #[Assert\Positive]
    public int $page = 1;
    public int $perPage = 12;
}
