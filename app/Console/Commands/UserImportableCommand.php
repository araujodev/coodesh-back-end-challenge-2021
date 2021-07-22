<?php

namespace App\Console\Commands;

use App\Jobs\ProcessUserImport;
use Illuminate\Console\Command;

class UserImportableCommand extends Command
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
    protected $description = 'Import users from Datasource using Restful Apis';

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
     * @return void
     */
    public function handle(): void
    {
        $this->info(trans('messages.import_user_scheduled'));
        ProcessUserImport::dispatch();
    }
}
