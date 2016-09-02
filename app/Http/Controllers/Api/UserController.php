<?php

namespace App\Http\Controllers\Api;

use App\Transformers\UserTransformer;
use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UserController extends ApiController
{
    use Helpers;

    public function index(Request $request)
    {
        $users = User::take(20)->get();

        return $this->respondWithCollection($users, new UserTransformer);

    }

    public function show($uuid)
    {
        $user = User::whereUuid($uuid)->firstOrFail();

        return $this->respondWithItem($user, new UserTransformer);
    }

    public function getCurrentUser(Request $request)
    {
        $this->guard();
        $user = $this->getUserByToken();

        return $this->respondWithItem($user, new UserTransformer);
    }

    public function update($uuid)
    {
        $this->guard();
        $currentUser = $this->getUserByToken();

        $user = User::firstOrFail(['uuid' => $uuid]);

        // TODO Check if current user may update the target user

        return $this->setStatusCode(HttpResponse::HTTP_ACCEPTED)
            ->respondWithItem($user, new UserTransformer);
    }

    /*public function create(Request $request)
    {
        if (User::create($request->only('name'))) {
            return $this->response->created();
        }

        return $this->response->errorBadRequest();
    }*/
}
