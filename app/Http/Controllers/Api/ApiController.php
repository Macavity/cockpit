<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class ApiController extends Controller
{
    protected $fractal;

    protected $statusCode = BaseResponse::HTTP_OK;

    const ERROR_WRONG_ARGS = 'error_wrong_arguments';
    const ERROR_NOT_FOUND = 'error_not_found';
    const ERROR_INTERNAL_ERROR = 'error_internal';
    const ERROR_UNAUTHORIZED = 'error_unauthorized';
    const ERROR_FORBIDDEN = 'error_forbidden';

    const ERROR_TOKEN_EXPIRED = 'token_expired';
    const ERROR_TOKEN_INVALID = 'token_invalid';
    const ERROR_TOKEN_ABSENT = 'token_absent';
    const ERROR_INVALID_CREDENTIALS = 'invalid_credentials';
    const ERROR_TOKEN_ERROR = 'could_not_create_token';

    const SUCCESS_CREATED = 'resource_created';

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     *  API Login, on success return JWT Auth token
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->errorUnauthorized();
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->errorInternalError();
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        JWTAuth::invalidate($request->input('token'));
    }

    /**
     * Returns the authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticatedUser(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return $this->errorNotFound();
            }
        } catch (TokenExpiredException $e) {
            return $this->errorUnauthorized();
        } catch (TokenInvalidException $e) {
            return $this->errorUnauthorized();
        } catch (JWTException $e) {
            return $this->errorUnauthorized();
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    public function getUserByToken()
    {
        return JWTAuth::parseToken()->authenticate();
    }

    public function guard()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
    }

    /**
     * Refresh the token
     *
     * @return mixed
     */
    public function getToken()
    {
        $token = JWTAuth::getToken();

        if (!$token) {
            return $this->errorUnauthorized();
        }

        try {
            $refreshedToken = JWTAuth::refresh($token);
        }
        catch (JWTException $e) {
            // Unable to refresh token
            return $this->errorInternalError();
        }

        // Everything went well, return the refreshed token
        return $this->respondWithArray(['token' => $refreshedToken]);
    }


    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithArray(array $array, array $headers = [])
    {
        return response()->json($array, $this->statusCode, $headers);
    }

    protected function respondWithError($errorCode)
    {
        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => trans('api.'.$errorCode),
            ]
        ]);
    }

    public function errorForbidden()
    {
        return $this->setStatusCode(BaseResponse::HTTP_FORBIDDEN)
            ->respondWithError(self::ERROR_FORBIDDEN);
    }

    public function errorInternalError()
    {
        return $this->setStatusCode(BaseResponse::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError(self::ERROR_INTERNAL_ERROR);
    }

    public function errorNotFound()
    {
        return $this->setStatusCode(BaseResponse::HTTP_NOT_FOUND)
            ->respondWithError(self::ERROR_NOT_FOUND);
    }

    public function errorUnauthorized()
    {
        return $this->setStatusCode(BaseResponse::HTTP_UNAUTHORIZED)
            ->respondWithError(self::ERROR_UNAUTHORIZED);
    }

    public function errorWrongArguments()
    {
        return $this->setStatusCode(BaseResponse::HTTP_BAD_REQUEST)
            ->respondWithError(self::ERROR_WRONG_ARGS);
    }
}
