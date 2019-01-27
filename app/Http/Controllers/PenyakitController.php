<?php

namespace App\Http\Controllers;

use App\Article;
use App\Helpers\FunctionsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyakitController extends Controller
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

        $gizi = Article::with('category', 'user')->active()->penyakit()->get();
        if (!$gizi || count($gizi) == 0) {
            return response()->json(FunctionsHelper::response(404, 0, []), 404);
        }

        $response = [];
        foreach ($gizi as $value)
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

        $gizi_detail = Article::with('category', 'user')
            ->active()
            ->penyakit()
            ->where('article_slug', $request->article_slug)
            ->first();

        if (!$gizi_detail || count($gizi_detail) == 0) {
            return response()->json(FunctionsHelper::response(404, 0, []), 404);
        }
        return response()->json(FunctionsHelper::response(200, 1, $this->withResponse($gizi_detail)), 200);
    }

    protected function withResponse($gizi_detail)
    {
        $response = [
            'article_id' => $gizi_detail->article_id,
            'article_title' => $gizi_detail->article_title,
            'article_slug' => $gizi_detail->article_slug,
            'article_content' => $gizi_detail->article_content,
            'article_image' => $gizi_detail->article_image,
            'article_created' => $gizi_detail->created_at,
            'category_name' => $gizi_detail->category->category_name,
            'user_name' => $gizi_detail->user->name,
            'user_avatar' => $gizi_detail->user->avatar
        ];
        return $response;
    }
}