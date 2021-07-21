<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UserImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from https://randomuser.me/documentation';

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
    public function handle(): int
    {
        return 0;
    }
}
