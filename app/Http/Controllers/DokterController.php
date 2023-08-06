<?php

namespace App\Http\Controllers;

use App\Models\Apoteker;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index()
    {
        return view('dokter.home');
    }

    public function nomorAntrian()
    {
        $date = Carbon::now()->format('Y-m-d');

        $data = Pasien::with('user')
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

    public function simpanResep(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');

        $data = Apoteker::where('tanggal', $today)->latest()->first();

        $nomor_antrian = isset($data->nomor_antrian) ? ((int)$data->nomor_antrian + 1) : 1;

        $credentials = [
            "nomor_antrian" => $nomor_antrian,
            "tanggal" => $today,
            "pasien_id" => $request->antrian_id,
            "resep" => $request->resep
        ];

        $apoteker = Apoteker::create($credentials);

        Pasien::find($request->antrian_id)
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
