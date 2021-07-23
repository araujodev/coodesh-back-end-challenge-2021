<?php

namespace App\Console\Commands;

use App\Services\ApiKeyService;
use Illuminate\Console\Command;

class ApiKeyGenerationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apikey:generate {--C|client_name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Security mode. Generate api key value';

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
    public function handle(ApiKeyService $apiKeyService): int
    {
        $clientName = $this->option('client_name');
        $authorization = $apiKeyService->generate($clientName);

        if ($authorization === null) {
            $this->info(trans('messages.apikey_generate_failed'));
            return 0;
        }

        $this->info(trans('messages.apikey_generate_success', [
            'key' => $authorization->key,
            'value' =>$authorization->sha1_value
        ]));
        return 0;
    }
}
