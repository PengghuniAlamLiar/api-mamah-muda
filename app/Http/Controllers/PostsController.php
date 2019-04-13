<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionsHelper;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    protected $auth;
    protected $category = false;
    const GIZI = 1;
    const PENYAKIT = 2;

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
        $this->auth = Auth::guard()->user();
    }

    public  function index(Request $request)
    {
        if (!$this->auth) {
            return response()->json(FunctionsHelper::response(401, 0, []), 401);
        }
        $this->checkCategory($request);
        if (!$this->category) {
            return response()->json(FunctionsHelper::response(404, 0, []), 401);
        }

        return Post::publish()->with(['user', 'term_relationship'])
            ->get();
    }

    private function checkCategory($request)
    {
        if ($request->category == "gizi") {
            $this->category = self::GIZI;
        }
        if ($request->category == "penyakit") {
            $this->category = self::PENYAKIT;
        }
    }
}
