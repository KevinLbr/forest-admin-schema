<?php

namespace KevinLbr\ForestAdminSchema\Tests\Unit;

use KevinLbr\ForestAdminSchema\Domain\Scan\Models\Column;
use KevinLbr\ForestAdminSchema\Domain\Scan\Models\Table;
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

    /**
     * @test
     */
    public function should_one_table_without_column()
    {
        //Arrange
        $nameTable = "users";
        $table = new Table($nameTable);
        $this->repository->setTables([$table]);

        //Act
        $tables = (new ScanRepositoryService($this->repository))->getTables();

        // Asserts
        $this->assertContains($table, $tables);
    }

    /**
     * @test
     */
    public function should_one_table_with_one_column()
    {
        //Arrange
        $nameTable = "users";
        $nameColumn = "name";
        $typeColumn = Column::TYPE_VARCHAR;
        $column = new Column($nameColumn, $typeColumn);
        $table = new Table($nameTable, [$column]);
        $this->repository->setTables([$table]);

        //Act
        $tables = (new ScanRepositoryService($this->repository))->getTables();

        // Asserts
        $this->assertContains($table, $tables);
        $this->assertContains($column, $table->getColumns());
        $this->assertEquals($column->getName(), $nameColumn);
        $this->assertEquals($column->getType(), $typeColumn);
    }

    /**
     * @test
     */
    public function should_one_table_with_many_columns()
    {
        //Arrange
        $nameTable = "users";
        $nameColumn1 = "name";
        $typeColumn1 = Column::TYPE_VARCHAR;
        $column1 = new Column($nameColumn1, $typeColumn1);

        $nameColumn2 = "description";
        $typeColumn2 = Column::TYPE_TEXT;
        $column2 = new Column($nameColumn2, $typeColumn2);

        $table = new Table($nameTable, [$column1, $column2]);
        $this->repository->setTables([$table]);

        //Act
        $tables = (new ScanRepositoryService($this->repository))->getTables();

        // Asserts
        $this->assertEquals([$column1, $column2], $table->getColumns());
    }

    /**
     * @test
     */
    public function should_many_table_with_many_columns()
    {
        //Arrange
        // Table 1
        $nameTable1 = "users";
        $nameColumn1 = "name";
        $typeColumn1 = Column::TYPE_VARCHAR;
        $column1 = new Column($nameColumn1, $typeColumn1);

        $nameColumn2 = "description";
        $typeColumn2 = Column::TYPE_TEXT;
        $column2 = new Column($nameColumn2, $typeColumn2);

        $table1 = new Table($nameTable1, [$column1, $column2]);

        // Table 2
        $nameTable2 = "products";
        $nameColumn3 = "id";
        $typeColumn3 = Column::TYPE_INT;
        $column3 = new Column($nameColumn3, $typeColumn3);

        $nameColumn4 = "description";
        $typeColumn4 = Column::TYPE_TEXT;
        $column4 = new Column($nameColumn4, $typeColumn4);

        $table2 = new Table($nameTable2, [$column3, $column4]);

        $this->repository->setTables([$table1, $table2]);

        //Act
        $tables = (new ScanRepositoryService($this->repository))->getTables();

        // Asserts
        $this->assertEquals([$table1, $table2], $tables);
    }
}
