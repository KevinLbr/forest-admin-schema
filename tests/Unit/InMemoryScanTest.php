<?php

namespace KevinLbr\ForestAdminSchema\Tests\Unit;

use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\FileStorageRepositoryInterface;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\InMemoryFileStorageRepository;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\InMemoryTablesRepository;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\TablesRepositoryInterface;

class InMemoryScanTest extends \KevinLbr\ForestAdminSchema\Tests\Unit\ScanAbstract
{
    /**
     * @var TablesRepositoryInterface
     */
    private $repository;

    /**
     * @var FileStorageRepositoryInterface
     */
    private $fileStorageRepository;

    /**
     * @var string
     */
    private $path;

    public function setUp(): void
    {
        $this->repository = new InMemoryTablesRepository();
        $this->fileStorageRepository = new InMemoryFileStorageRepository();
        $this->path = __DIR__ . "/forestadmin-schema.json";
        parent::setUp();
    }
}
