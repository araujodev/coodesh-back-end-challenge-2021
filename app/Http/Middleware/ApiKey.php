<?php

namespace App\Http\Middleware;

use App\Models\Authorization;
use App\Services\ApiKeyService;
use Closure;
use Illuminate\Http\Request;

class ApiKey
{

    private $apiKeyService;

    public function __construct(ApiKeyService $apiKeyService)
    {
        $this->apiKeyService = $apiKeyService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKeyHeaderValue = $request->header(Authorization::KEY_NAME);

        if ($apiKeyHeaderValue === null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $authorization = $this->apiKeyService->getOneByValue($apiKeyHeaderValue);
        if(data_get($authorization, 'key') !== Authorization::KEY_NAME ||
            data_get($authorization, 'sha1_value') !== $apiKeyHeaderValue) {

            return response()->json(['error' => 'Unauthorized'], 401);

        }

        return $next($request);
    }
}
