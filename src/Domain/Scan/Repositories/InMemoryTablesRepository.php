<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Repositories;


use KevinLbr\ForestAdminSchema\Domain\Scan\Models\Table;

class InMemoryTablesRepository implements TablesRepositoryInterface
{
    /**
     * @var Table[]
     */
    private $tables;

    /**
     * @param Table[] $tables
     */
    public function setTables(array $tables): void
    {
        $this->tables = $tables;
    }

    public function getTables(): array
    {
        return $this->tables;
    }
}
