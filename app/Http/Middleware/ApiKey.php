<?php

namespace App\Http\Middleware;

use App\Enumerators\AuthorizationStatusEnum;
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

        if (false === $this->apiKeyService->compareIsValidKey($apiKeyHeaderValue)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
