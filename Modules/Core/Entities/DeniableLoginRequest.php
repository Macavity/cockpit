<?php namespace Modules\Core\Entities;

use \Illuminate\Http\Request;

trait DeniableLoginRequest
{
    use TranslationHelper;

    /**
     * @param Request $request
     * @param string $routeName
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function denied(Request $request, $routeName = 'login')
    {
        if ($request->ajax()) {
            $message = $this->translate('unauthorized', 'Unauthorized');
            return response()->json(['error' => $message], 401);
        } else {
            return redirect()->to(route($routeName));
        }
    }
}
