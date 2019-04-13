<?php

namespace App\Http\Controllers;

use App\Article;
use App\Helpers\FunctionsHelper;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipsController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
        $this->auth = Auth::guard()->user();
    }

    public function index()
    {
        if (!$this->auth) {
            return response()->json(FunctionsHelper::response(401, 0, []), 401);
        }

        $tips = Article::with('category', 'user')->active()->tips()->get();
        if (!$tips || count($tips) == 0) {
            return response()->json(FunctionsHelper::response(404, 0, []), 404);
        }

        $response = [];
        foreach ($tips as $value)
        {
            $response[] = $this->withResponse($value);
        }
        return response()->json(FunctionsHelper::response(200, 1, $response), 200);
    }

    public function detail(Request $request)
    {
        if (!$this->auth) {
            return response()->json(FunctionsHelper::response(401, 0, []), 401);
        }

        $tips_detail = Article::with('category', 'user')
            ->active()
            ->tips()
            ->where('article_slug', $request->article_slug)
            ->first();

        if (!$tips_detail || count($tips_detail) == 0) {
            return response()->json(FunctionsHelper::response(404, 0, []), 404);
        }
        return response()->json(FunctionsHelper::response(200, 1, $this->withResponse($tips_detail)), 200);
    }

    protected function withResponse($tips_detail)
    {
        $response = [
            'article_id' => $tips_detail->article_id,
            'article_title' => $tips_detail->article_title,
            'article_slug' => $tips_detail->article_slug,
            'article_content' => $tips_detail->article_content,
            'article_image' => $tips_detail->article_image,
            'article_created' => $tips_detail->created_at,
            'category_name' => $tips_detail->category->category_name,
            'user_name' => $tips_detail->user->name,
            'user_avatar' => $tips_detail->user->avatar
        ];
        return $response;
    }
}