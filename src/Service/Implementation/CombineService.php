<?php

namespace App\Service\Implementation;

use App\Entity\Combine;
use App\Repository\Interface\ICombineRepository;
use App\Service\Interface\ICombineService;
use App\Service\Interface\IImageService;
use Doctrine\ORM\Exception\ORMException;

class CombineService implements ICombineService
{

    function __construct(
        private readonly ICombineRepository $combineRepository
    )
    {

    }
    public function create(Combine $combine): bool
    {
        try {
            $this->combineRepository->save($combine);
            return true;
        }
        catch (ORMException $e) {
            return false;
        }
    }

    public function update(Combine $combine): bool
    {
        try {
            $this->combineRepository->update($combine);
            return true;
        }
        catch (ORMException $e) {
            return false;
        }
    }

    public function delete(Combine $combine): bool
    {
        try {
            $this->combineRepository->softDelete($combine);
            return true;
        }
        catch (ORMException $e) {
            return false;
        }
    }

    public function getById(int $id): ?Combine
    {
        // TODO: Implement getById() method.
    }

    public function getAll(): array
    {
        return $this->combineRepository->findAll();
    }
}
