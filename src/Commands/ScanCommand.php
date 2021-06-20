<?php

namespace KevinLbr\ForestAdminSchema\Commands;

use Illuminate\Console\Command;

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
        return 0;
    }
}
