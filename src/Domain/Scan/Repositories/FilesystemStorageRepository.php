<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Repositories;


class FilesystemStorageRepository implements FileStorageRepositoryInterface
{
    public function save(string $path, array $json): bool
    {
        return file_put_contents($path, json_encode($json)) == 0 ? false : true;
    }

    public function fileExists(string $path): bool
    {
        return file_exists($path);
    }

    public function remove(string $path): bool
    {
        if($this->fileExists($path)){
            unlink($path);
        }

        return ! $this->fileExists($path);
    }

    public function get(string $path)
    {
        return file_get_contents($path);
    }
}
