<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Brosur;
use Illuminate\Support\Facades\DB;

class BrosurController extends Controller
{
    public function index()
    {
        $brosur=DB::table('mobil')->select('nama_mobil', 'tipe_mobil', 'jenis_transmisi', 'jenis_bahan_bakar', 'warna', 'volume_bagasi', 'fasilitas', 'harga_sewa')->where('status_mobil', "!=", "Berhenti")->get();

        if(count($brosur)>0) {
            return response([
                'message' => 'Retrieve All Success',
                'brosur' => $brosur
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'brosur' => null
        ], 400);
    }
}
