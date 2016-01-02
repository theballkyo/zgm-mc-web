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

		if (!Cache::has('mc_status')) {
			try
			{
				$Query = new MinecraftQuery();
				$Query->Connect('mc-sv1.enjoyprice.in.th', 25565);
				Cache::add('mc_status', $Query, 1);
			} catch (MinecraftQueryException $e) {
				Cache::add('mc_status', false, 1);
			}

		}

		view()->share('mc_status', Cache::get('mc_status', false));

		return $next($request);
	}
}
