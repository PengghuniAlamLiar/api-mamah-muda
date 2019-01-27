<?php

namespace App\Exceptions;

use App\Helpers\FunctionsHelper;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof UnauthorizedHttpException) {
            if ($e->getPrevious() instanceof TokenExpiredException) {
                return response()->json( FunctionsHelper::response($e->getStatusCode(), 0, ['error' => 'TOKEN_EXPIRED']), $e->getStatusCode());
            } else if ($e->getPrevious() instanceof TokenInvalidException) {
                return response()->json( FunctionsHelper::response($e->getStatusCode(), 0, ['error' => 'TOKEN_INVALID']), $e->getStatusCode());
            } else if ($e->getPrevious() instanceof TokenBlacklistedException) {
                return response()->json( FunctionsHelper::response($e->getStatusCode(), 0, ['error' => 'TOKEN_BLACKLISTED']), $e->getStatusCode());
            } else {
                return response()->json(FunctionsHelper::response(401, 0, ['error' => "UNAUTHORIZED_REQUEST"]), 401);
            }
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
        {
            return response()->json(FunctionsHelper::response($e->getStatusCode(), 0, ['error' => 'NOT_FOUND']), $e->getStatusCode());
        }

        return parent::render($request, $e);
    }
}
