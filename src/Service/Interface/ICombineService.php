<?php

namespace App\Service\Interface;

use App\Entity\Combine;

interface ICombineService
{
    public function create(Combine $combine): bool;
    public function update(Combine $combine): bool;
    public function delete(Combine $combine): bool;
    public function getById(int $id): ?Combine;
    public function getAll(): array;
}
