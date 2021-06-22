<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Repositories;


class StorageRepository implements FileStorageRepositoryInterface
{
    public function save(string $path, array $json): bool
    {
        // TODO
        return true;
    }

    public function fileExists(string $path): bool
    {
        // TODO
        return true;
    }

    public function remove(string $path): bool
    {
        if($this->fileExists($path)){
            // TODO
        }

        return ! $this->fileExists($path);
    }
}
