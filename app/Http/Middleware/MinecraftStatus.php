<?php

namespace App\Http\Middleware;

use Cache;
use Closure;
use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;

class MinecraftStatus {
	/**
	 * Get Minecraft Server Status
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null) {

		view()->share('mc_status', false);

		return $next($request); 
	}
}
