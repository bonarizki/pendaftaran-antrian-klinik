<?php

namespace App\Http\Controllers;

use App\Models\Apoteker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    public function index()
    {
        return view('apoteker.home');
    }

    public function nomorAntrian()
    {
        $date = Carbon::now()->format('Y-m-d');

        $data = Apoteker::with('pasien.user')
            ->where('tanggal', $date)
            ->where('status', 'aktif')
            ->orderBy('created_at')
            ->first();
        
        return response()->json([
            "status" => "success",
            "code" => 200,
            "message" => "data berhasil di dapat",
            "data" => $data
        ],200);
    }

    public function antrianSelesai(Request $request)
    {
        $apoteker = Apoteker::find($request->antrian_id)
            ->update([
                "status" => "done"
            ]);

        return response()->json([
            "status" => "success",
            "code" => 200,
            "message" => "nomor antrian resep berhasil terdaftar",
            "data" => $apoteker
        ],200);
    }
}
