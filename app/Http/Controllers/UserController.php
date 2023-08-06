<?php

namespace App\Http\Controllers;

use App\Models\Apoteker;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function daftar()
    {
        $today = Carbon::now()->format('Y-m-d');

        $data = Pasien::where('tanggal', $today)->latest()->first();

        $nomor_antrian = isset($data->nomor_antrian) ? ((int)$data->nomor_antrian + 1) : 1;

        $credentials = [
            "nomor_antrian" => $nomor_antrian,
            "tanggal" => $today,
            "user_id" => Auth::user()->id
        ];

        $pasien = Pasien::create($credentials);

        return response()->json([
            "status" => "success",
            "code" => 200,
            "message" => "nomor antrian berhasil terdaftar",
            "data" => $pasien
        ],200);
    }

    public function cek()
    {
        $data = Pasien::where('user_id', Auth::user()->id)
            ->latest()
            ->first();
        
        return response()->json([
            "status" => "success",
            "code" => 200,
            "message" => "data berhasil di dapat",
            "data" => $data
        ],200);
    }

    public function antrianObat()
    {
        return view('user.antrian-obat');
    }

    public function getAntrianObat()
    {
        $data = Apoteker::with('pasien')
            ->whereHas('pasien', function($q) {
                $q->where('user_id', Auth::user()->id)
                    ->latest();
            })
            ->latest()
            ->first();
        
        return response()->json([
            "status" => "success",
            "code" => 200,
            "message" => "data berhasil di dapat",
            "data" => $data
        ],200);
    }

    public function done()
    {
        return view('user.done');
    }
}
