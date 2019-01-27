<?php

namespace App\Http\Controllers;

use App\Article;
use App\Helpers\FunctionsHelper;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
        $this->auth = Auth::guard()->user();
    }

    public function gizi()
    {
        if (!$this->auth) {
            return response()->json(FunctionsHelper::response(401, 0, []), 401);
        }

        $gizi = Article::with('category', 'user')->active()->gizi()->get();
        if (!$gizi || count($gizi) == 0) {
            return response()->json(FunctionsHelper::response(404, 0, []), 404);
        }

        $response = [];
        foreach ($gizi as $value)
        {
            $response[] = [
                'article_id' => $value->article_id,
                'article_title' => $value->article_title,
                'article_content' => $value->article_content,
                'article_image' => $value->article_image,
                'article_created' => $value->created_at,
                'category_name' => $value->category->category_name,
                'user_name' => $value->user->name,
                'user_avatar' => $value->user->avatar
            ];
        }

        return response()->json(FunctionsHelper::response(200, 1, $response), 200);
    }

    public function penyakit()
    {
        if (!$this->auth) {
            return response()->json(FunctionsHelper::response(401, 0, []), 401);
        }

        $penyakit = Article::with('category', 'user')->active()->penyakit()->get();
        if (!$penyakit || count($penyakit) == 0) {
            return response()->json(FunctionsHelper::response(404, 0, []), 404);
        }

        $response = [];
        foreach ($penyakit as $value)
        {
            $response[] = [
                'article_id' => $value->article_id,
                'article_title' => $value->article_title,
                'article_content' => $value->article_content,
                'article_image' => $value->article_image,
                'article_created' => $value->created_at,
                'category_name' => $value->category->category_name,
                'user_name' => $value->user->name,
                'user_avatar' => $value->user->avatar
            ];
        }

        return response()->json(FunctionsHelper::response(200, 1, $response), 200);
    }
}