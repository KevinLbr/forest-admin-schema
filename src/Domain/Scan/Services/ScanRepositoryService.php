<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Services;


use KevinLbr\ForestAdminSchema\Domain\Scan\Models\Table;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\FileStorageRepositoryInterface;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\TablesRepositoryInterface;

class ScanRepositoryService
{
    /**
     * @var TablesRepositoryInterface
     */
    private $repository;

    /**
     * @var FileStorageRepositoryInterface
     */
    private $fileStorageRepository;

    public function __construct(TablesRepositoryInterface $repository, FileStorageRepositoryInterface $fileStorageRepository)
    {
        $this->repository = $repository;
        $this->fileStorageRepository = $fileStorageRepository;
    }

    /**
     * @return Table[]
     */
    public function getTables(): array
    {
        return $this->repository->getTables();
    }

    public function getJson(): array
    {
        $json = [];
        foreach($this->getTables() as $table){
            $json[] = $this->buildTable($table);
        }

        return $json;
    }

    private function buildTable(Table $table) : array
    {
        $jsonTable = [
            "table" => $table->getName(),
            "qty_columns" => count($table->getColumns()),
        ];

        $jsonTable['columns'] = $this->buildColumns($table);

        return $jsonTable;
    }

    private function buildColumns(Table $table) : array
    {
        $columns = [];
        foreach($table->getColumns() as $column){
            $columns[]= [
                "name" => $column->getName(),
                "type" => $column->getType(),
            ];
        }

        return $columns;
    }

    public function saveJson(string $path): bool
    {
        $json = $this->getJson();
        return $this->fileStorageRepository->save($path, $json);
    }
}
