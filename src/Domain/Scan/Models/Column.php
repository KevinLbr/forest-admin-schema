<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Models;


class Column
{
    const TYPES = [
        self::TYPE_STRING, self::TYPE_TEXT, self::TYPE_INTEGER
    ];

    const TYPE_STRING = "string";
    const TYPE_TEXT = "text";
    const TYPE_INTEGER = "integer";

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
