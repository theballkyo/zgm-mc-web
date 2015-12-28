<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use App\Minecraft\MinecraftServerStatus;
use Illuminate\Support\Facades\Auth;

class MinecraftStatus
{
    /**
     * Get Minecraft Server Status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $status = new MinecraftServerStatus();

        if(!Cache::has('mc_status')) {
            Cache::add('mc_status', $status->getStatus('mc-sv1.enjoyprice.in.th'), 1);
        }

        view()->share('mc_status', Cache::get('mc_status', false));

        return $next($request);
    }
}
