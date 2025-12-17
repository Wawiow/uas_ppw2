<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        // Chart 1: Gender
        $gender = Pegawai::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender');

        $genderLabels = $gender->keys();
        $genderData   = $gender->values();

        // Chart 2: Top 5 pekerjaan
        $pekerjaan = Pekerjaan::withCount('pegawai')
            ->orderByDesc('pegawai_count')
            ->limit(5)
            ->get();

        $jobLabels = $pekerjaan->pluck('nama');
        $jobData   = $pekerjaan->pluck('pegawai_count');

        return view('index', compact(
            'genderLabels',
            'genderData',
            'jobLabels',
            'jobData'
        ));
    }
}
