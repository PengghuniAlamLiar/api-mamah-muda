<?php

namespace App\Http\Controllers;

use App\Gejala;
use App\Helpers\FunctionsHelper;
use Illuminate\Support\Facades\Auth;

class GejalaController extends Controller
{
    protected $auth;
    public function __construct()
    {
        // $this->middleware('jwt.auth', ['except' => ['login']]);
        // $this->auth = Auth::guard()->user();
    }

    public function index()
    {
        // if (!$this->auth) {
        //     return response()->json(FunctionsHelper::response(401, 0, []), 401);
        // }

        $gejala = Gejala::all();
        if (!$gejala) {
            return FunctionsHelper::response(404, 0, []);
        }
        return FunctionsHelper::response(200, 1, self::buildGejala($gejala));
    }

    public function buildGejala($gejala)
    {
        $result = [];
        foreach ($gejala as $item) {
            $result[] = [
                'gejala_id' => $item->gejala_id,
                'gejala_code' => $item->gejala_code,
                'gejala_desc' => $item->gejala_desc
            ];
        }
        return $result;
    }
}
