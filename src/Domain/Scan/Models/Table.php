<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Models;


class Table
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Column[]
     */
    private $columns;

    /**
     * Table constructor.
     * @param string $name
     * @param Column[] $columns
     */
    public function __construct(string $name, array $columns = [])
    {
        $this->name = $name;
        $this->columns = $columns;
    }

    /**
     * @return Column[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }
}
