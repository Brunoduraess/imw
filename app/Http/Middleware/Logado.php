<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Logado
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user')) {
            session()->flush();
            return redirect()->to('/login');
        }

        return $next($request);
    }
}
