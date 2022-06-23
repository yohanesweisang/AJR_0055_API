<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Promo;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    public function index()
    {
        $promo = DB::table('promo')->select('*')->where('status_promo', "=", "Aktif")->get();

        if(count($promo) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'promo' => $promo
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'promo' => null
        ], 400);
    }
}
