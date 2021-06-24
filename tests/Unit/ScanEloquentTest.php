<?php

namespace KevinLbr\ForestAdminSchema\Tests\Unit;

use Illuminate\Database\Schema\Blueprint;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\EloquentTablesRepository;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\FileStorageRepositoryInterface;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\StorageRepository;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\TablesRepositoryInterface;
use KevinLbr\ForestAdminSchema\Domain\Scan\Services\ScanRepositoryService;
use KevinLbr\ForestAdminSchema\Tests\TestCase;

class ScanEloquentTest extends TestCase
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
        parent::setUp();
        $this->repository = new EloquentTablesRepository();
        $this->fileStorageRepository = new StorageRepository();
        $this->path = __DIR__ . "/forestadmin-schema.json";
    }

    protected function tearDown(): void
    {
        parent::tearDown();

//        $this->fileStorageRepository->remove($this->path);
        // TODO remove all tables
    }

    /**
     * @test
     */
    public function should_save_json_with_one_table_with_one_column()
    {
        // Arrange
        $this->app['db']->connection()->getSchemaBuilder()->create("users", function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        //Act
        $success = (new ScanRepositoryService($this->repository, $this->fileStorageRepository))->saveJson($this->path);

        // Asserts
        $this->assertTrue($success);
        $this->assertTrue($this->fileStorageRepository->fileExists($this->path));
    }
}
