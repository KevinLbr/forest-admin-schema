<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Models;


class Column
{
    const TYPES = [
        self::TYPE_VARCHAR, self::TYPE_TEXT, self::TYPE_INT
    ];

    const TYPE_VARCHAR = "varchar";
    const TYPE_TEXT = "text";
    const TYPE_INT = "int";

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
