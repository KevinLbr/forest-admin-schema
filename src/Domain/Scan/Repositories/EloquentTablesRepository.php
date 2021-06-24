<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Repositories;


use Illuminate\Support\Facades\DB;
use KevinLbr\ForestAdminSchema\Domain\Scan\Models\Column;
use KevinLbr\ForestAdminSchema\Domain\Scan\Models\Table;

class EloquentTablesRepository implements TablesRepositoryInterface
{
    public function getTables(): array
    {
        $tablesNames = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        $tables = [];
        foreach($tablesNames as $tableName){
            $tables[] = $this->setTable($tableName);
        }

        return $tables;
    }

    private function setTable(string $name): Table
    {
        $columnsNames = DB::connection()->getSchemaBuilder()->getColumnListing($name);
        $columns = [];
        foreach($columnsNames as $columnsName){
            $type = DB::connection()->getDoctrineColumn($name, $columnsName)->getType()->getName();
            $columns[] = new Column($columnsName, $type);
        }

        return new Table($name, $columns);
    }
}
