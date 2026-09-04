<?php
declare(strict_types=1);
namespace App\Repository\Interface;

use App\Entity\Combine;

interface ICombineRepository
{
    public function save(Combine $combine, bool $flush = true): ?Combine;
    public function update(Combine $combine);
    public function softDelete(Combine $combine);
    public function hardDelete(Combine $combine);
    public function getById($value): ?Combine;
}
