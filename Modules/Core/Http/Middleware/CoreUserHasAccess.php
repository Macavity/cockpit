<?php namespace Modules\Core\Http\Middleware;

use Closure;
use Modules\Core\Entities\DeniableLoginRequest;
use Sentinel;

class CoreUserHasAccess
{
    use DeniableLoginRequest;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!Sentinel::check()) {
            return $this->denied($request);
        }

        if (!Sentinel::hasAccess($permission)) {
            $message = $this->translate('need_permission', 'You do not have permission to do that.');
            session()->flash('error', $message);
            return $this->denied($request);
        }

    	return $next($request);
    }

}
