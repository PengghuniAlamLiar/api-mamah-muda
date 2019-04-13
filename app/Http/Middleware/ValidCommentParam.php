<?php

namespace App\Http\Middleware;

use App\Helpers\FunctionsHelper;
use Closure;
use Validator;

class ValidCommentParam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $valid_param = [
            'article_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $valid_param);
        if ($validator->fails()) {
            return response()->json(FunctionsHelper::response(403, 0, []), 403);
        }

        return $next($request);
    }
}
