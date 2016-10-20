<?php namespace Modules\Core\Http\Middleware;

use Closure;
use \Illuminate\Http\Request;
use Modules\Core\Entities\DeniableLoginRequest;
use Sentinel;

class CoreAuthenticate
{
    use DeniableLoginRequest;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Sentinel::check()) {
            if ($request->ajax()) {
                $message = $this->translate('unauthorized', 'Unauthorized');
                return response()->json(['error' => $message], 401);
            } else {
                return redirect()->guest(route('login'));
            }
        }

        return $next($request);
    }
}
