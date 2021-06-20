<?php

namespace KevinLbr\ForestAdminSchema\Tests\Unit;

use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\InMemoryTablesRepository;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\TablesRepositoryInterface;
use KevinLbr\ForestAdminSchema\Domain\Scan\Services\ScanRepositoryService;
use PHPUnit\Framework\TestCase;

class ScanTest extends TestCase
{
    /**
     * @var TablesRepositoryInterface
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryTablesRepository();
    }

    /**
     * @test
     */
    public function should_have_nothing()
    {
        //Arrange
        $this->repository->setTables([]);

        //Act
        $tables = (new ScanRepositoryService($this->repository))->getTables();

        // Asserts
        $this->assertEmpty($tables);
    }
}
