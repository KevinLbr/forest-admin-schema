<?php

namespace KevinLbr\ForestAdminSchema\Tests\Unit;

use Illuminate\Database\Schema\Blueprint;
use KevinLbr\ForestAdminSchema\Domain\Scan\Models\Column;
use KevinLbr\ForestAdminSchema\Domain\Scan\Models\Table;
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
        $this->fileStorageRepository->remove($this->path);

        parent::tearDown();
    }

    /**
     * @test
     */
    public function should_have_nothing()
    {
        //Act
        $tables = (new ScanRepositoryService($this->repository, $this->fileStorageRepository))->getTables();

        // Asserts
        $this->assertEmpty($tables);
    }

    /**
     * @test
     */
    public function should_have_one_table_with_one_column()
    {
        //Arrange
        $nameTable = "users";
        $nameColumn = "name";
        $typeColumn = "string";

        $this->app['db']->connection()->getSchemaBuilder()->create($nameTable, function(Blueprint $table) use($nameColumn){
            $table->string($nameColumn);
        });

        //Act
        $tables = (new ScanRepositoryService($this->repository, $this->fileStorageRepository))->getTables();


        // Asserts
        $this->assertEquals($nameTable, $tables[0]->getName());
        $this->assertEquals($nameColumn, $tables[0]->getColumns()[0]->getName());
        $this->assertEquals($typeColumn, $tables[0]->getColumns()[0]->getType());
    }

    /**
     * @test
     */
    public function should_have_one_table_with_many_columns()
    {
        //Arrange
        $nameTable = "users";
        $nameColumn1 = "name";
        $typeColumn1 = "string";

        $nameColumn2 = "description";
        $typeColumn2 = Column::TYPE_TEXT;

        $this->app['db']->connection()->getSchemaBuilder()->create($nameTable, function(Blueprint $table) use($nameColumn1, $nameColumn2){
            $table->string($nameColumn1);
            $table->text($nameColumn2);
        });

        //Act
        $tables = (new ScanRepositoryService($this->repository, $this->fileStorageRepository))->getTables();

        // Asserts
        $this->assertEquals($nameTable, $tables[0]->getName());
        $this->assertEquals($nameColumn1, $tables[0]->getColumns()[0]->getName());
        $this->assertEquals($typeColumn1, $tables[0]->getColumns()[0]->getType());
        $this->assertEquals($nameColumn2, $tables[0]->getColumns()[1]->getName());
        $this->assertEquals($typeColumn2, $tables[0]->getColumns()[1]->getType());
    }

    /**
     * @test
     */
    public function should_have_many_tables_with_many_columns()
    {
        //Arrange
        // Table 1
        $nameTable1 = "users";
        $nameColumn1 = "name";
        $typeColumn1 = "string";

        $nameColumn2 = "description";
        $typeColumn2 = Column::TYPE_TEXT;

        // Table 2
        $nameTable2 = "products";
        $nameColumn3 = "id";
        $typeColumn3 = "integer";

        $nameColumn4 = "description";
        $typeColumn4 = Column::TYPE_TEXT;

        $this->app['db']->connection()->getSchemaBuilder()->create($nameTable1, function(Blueprint $table) use($nameColumn1, $nameColumn2){
            $table->string($nameColumn1);
            $table->text($nameColumn2);
        });

        $this->app['db']->connection()->getSchemaBuilder()->create($nameTable2, function(Blueprint $table) use($nameColumn3, $nameColumn4){
            $table->integer($nameColumn3);
            $table->text($nameColumn4);
        });

        //Act
        $tables = (new ScanRepositoryService($this->repository, $this->fileStorageRepository))->getTables();

        // Asserts
        $this->assertEquals($nameTable1, $tables[1]->getName());
        $this->assertEquals($nameColumn1, $tables[1]->getColumns()[0]->getName());
        $this->assertEquals($typeColumn1, $tables[1]->getColumns()[0]->getType());
        $this->assertEquals($nameColumn2, $tables[1]->getColumns()[1]->getName());
        $this->assertEquals($typeColumn2, $tables[1]->getColumns()[1]->getType());

        $this->assertEquals($nameTable2, $tables[0]->getName());
        $this->assertEquals($nameColumn3, $tables[0]->getColumns()[0]->getName());
        $this->assertEquals($typeColumn3, $tables[0]->getColumns()[0]->getType());
        $this->assertEquals($nameColumn4, $tables[0]->getColumns()[1]->getName());
        $this->assertEquals($typeColumn4, $tables[0]->getColumns()[1]->getType());
    }

    /**
     * @test
     */
    public function should_have_json_with_one_table_with_one_column()
    {
        //Arrange
        $nameTable = "users";
        $nameColumn = "name";
        $typeColumn = "string";
        $column = new Column($nameColumn, $typeColumn);
        $table = new Table($nameTable, [$column]);

        $this->app['db']->connection()->getSchemaBuilder()->create($nameTable, function(Blueprint $table) use($nameColumn){
            $table->string($nameColumn);
        });

        //Act
        $json = (new ScanRepositoryService($this->repository, $this->fileStorageRepository))->getJSON();

        // Asserts
        $jsonExpected = [
            [
                "table" => $table->getName(),
                "qty_columns" => count($table->getColumns()),
                "columns" => [
                    [
                        "name" => $nameColumn,
                        "type" => $typeColumn,
                    ]
                ]
            ]
        ];

        $this->assertEquals($json, $jsonExpected);
    }


    /**
     * @test
     */
    public function should_have_json_with_many_tables_with_many_columns()
    {
        //Arrange
        // Table 1
        $nameTable1 = "users";
        $nameColumn1 = "name";
        $typeColumn1 = "string";
        $column1 = new Column($nameColumn1, $typeColumn1);

        $nameColumn2 = "description";
        $typeColumn2 = Column::TYPE_TEXT;
        $column2 = new Column($nameColumn2, $typeColumn2);

        $table1 = new Table($nameTable1, [$column1, $column2]);

        // Table 2
        $nameTable2 = "products";
        $nameColumn3 = "id";
        $typeColumn3 = "integer";
        $column3 = new Column($nameColumn3, $typeColumn3);

        $nameColumn4 = "description";
        $typeColumn4 = Column::TYPE_TEXT;
        $column4 = new Column($nameColumn4, $typeColumn4);

        $table2 = new Table($nameTable2, [$column3, $column4]);

        $this->app['db']->connection()->getSchemaBuilder()->create($nameTable1, function(Blueprint $table) use($nameColumn1, $nameColumn2){
            $table->string($nameColumn1);
            $table->text($nameColumn2);
        });

        $this->app['db']->connection()->getSchemaBuilder()->create($nameTable2, function(Blueprint $table) use($nameColumn3, $nameColumn4){
            $table->integer($nameColumn3);
            $table->text($nameColumn4);
        });

        //Act
        $json = (new ScanRepositoryService($this->repository, $this->fileStorageRepository))->getJSON();

        // Asserts
        $jsonExpected = [
            [
                "table" => $table2->getName(),
                "qty_columns" => count($table2->getColumns()),
                "columns" => [
                    [
                        "name" => $nameColumn3,
                        "type" => $typeColumn3,
                    ],
                    [
                        "name" => $nameColumn4,
                        "type" => $typeColumn4,
                    ]
                ]
            ],
            [
                "table" => $table1->getName(),
                "qty_columns" => count($table1->getColumns()),
                "columns" => [
                    [
                        "name" => $nameColumn1,
                        "type" => $typeColumn1,
                    ],
                    [
                        "name" => $nameColumn2,
                        "type" => $typeColumn2,
                    ]
                ]
            ]
        ];

        $this->assertEquals($json, $jsonExpected);
    }

    /**
     * @test
     */
    public function should_have_save_json_with_one_table_with_one_column()
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
