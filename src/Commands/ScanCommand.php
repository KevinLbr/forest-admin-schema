<?php

namespace KevinLbr\ForestAdminSchema\Commands;

use Illuminate\Console\Command;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\EloquentTablesRepository;
use KevinLbr\ForestAdminSchema\Domain\Scan\Repositories\StorageRepository;
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

        // TODO get count table
        // TODO start progress bar ?

        $success = (new ScanRepositoryService(new EloquentTablesRepository(), new StorageRepository()))->saveJson($path);

        // TODO end progress bar
        // TODO show result in terminal

        return $success;
    }
}
