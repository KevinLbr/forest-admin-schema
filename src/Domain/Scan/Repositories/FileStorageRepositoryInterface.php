<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Repositories;


interface FileStorageRepositoryInterface
{
    public function save(string $path, array $json): bool;

    public function fileExists(string $path): bool;

    public function remove(string $path): bool;
}
