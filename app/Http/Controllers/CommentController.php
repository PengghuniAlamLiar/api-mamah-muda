<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionsHelper;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
        $this->auth = Auth::guard()->user();
    }

    public function index(Request $request)
    {
        if (!$this->auth) {
            return response()->json(FunctionsHelper::response(401, 0, []), 401);
        }

        $comments = Comment::approved()
            ->with(['article' => function($query) {
                $query->select('article_id', 'article_title');
            }])
            ->with(['user' => function($query) {
                $query->select('id', 'name', 'avatar');
            }])
            ->where('article_id', $request->article_id)
            ->get();

        return $comments;
    }

    protected function withResponse()
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