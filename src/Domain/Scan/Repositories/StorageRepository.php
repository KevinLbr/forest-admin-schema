<?php


namespace KevinLbr\ForestAdminSchema\Domain\Scan\Repositories;


use Illuminate\Support\Facades\Storage;

class StorageRepository implements FileStorageRepositoryInterface
{
    public function save(string $path, array $json): bool
    {
        return Storage::put($path, json_encode($json));
    }

    public function fileExists(string $path): bool
    {
        return Storage::exists($path);
    }

    public function remove(string $path): bool
    {
        if($this->fileExists($path)){
            Storage::delete($path);
        }

        return ! $this->fileExists($path);
    }

    public function get(string $path)
    {
        return Storage::get($path);
    }
}
