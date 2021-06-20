<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Services;


use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\TablesRepositoryInterface;

class ScanRepositoryService
{
    /**
     * @var TablesRepositoryInterface
     */
    private $repository;

    public function __construct(TablesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getTables(): array
    {
        return $this->repository->getTables();
    }
}
