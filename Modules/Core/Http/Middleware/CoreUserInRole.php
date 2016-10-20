<?php namespace Modules\Core\Http\Middleware;

use Closure;
use Sentinel;
use Modules\Core\Entities\DeniableLoginRequest;

class CoreUserInRole
{
    use DeniableLoginRequest;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Sentinel::check()) {
            return $this->denied($request);
        }

        if (!Sentinel::inRole($role)) {
            $message = $this->translate('need_permission', 'You do not have permission to do that.');
            session()->flash('error', $message);
            return $this->denied($request);
        }

    	return $next($request);
    }

}
