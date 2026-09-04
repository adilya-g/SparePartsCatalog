<?php

namespace App\Service\Interface;

interface IImageService
{
    public function addCombineImage(int $combineId): bool;
    public function updateCombineImage(int $combineId): bool;
    public function addSparePartImage(int $sparePartId): bool;
    public function updateSparePartImage(int $sparePartId): bool;
}
