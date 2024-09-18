<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string $type): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $auth = auth()->user();
        $type = UserTypeEnum::tryFrom($type);
        if (!$auth->type->is($type)) {
            return redirect()->route($auth->type->loginRouteName());
        }
        return $next($request);
    }
}
