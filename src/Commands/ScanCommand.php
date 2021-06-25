<?php

namespace KevinLbr\ForestAdminSchema\Commands;

use Illuminate\Console\Command;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\DBTablesRepository;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\FilesystemStorageRepository;
use KevinLbr\ForestAdminSchema\Domain\Scan\Services\ScanRepositoryService;

class ScanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forest-admin-schema:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan BDD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = base_path() . '/forestadmin-schema.json';

        $success = (new ScanRepositoryService(new DBTablesRepository(), new FilesystemStorageRepository()))->saveJson($path);

        if($success){
            $this->info('The command was successful!');
        } else {
            $this->error('The command was not successful!');
        }

        return $success;
    }
}
