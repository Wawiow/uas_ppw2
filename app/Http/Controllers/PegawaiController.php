<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $data = Pegawai::with('pekerjaan')
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('nama', 'like', "%$keyword%")
                  ->orWhere('email', 'like', "%$keyword%");
            })
            ->paginate(5)
            ->withQueryString();

        return view('pegawai.index', compact('data'));
    }

    public function add()
    {
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.add', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'pekerjaan_id' => 'required',
            'nama' => 'required|string',
            'email' => 'required|email|unique:sedayuHS_543905_pegawai,email',
            'gender' => 'required|in:male,female',
            'is_active' => 'required|boolean',
        ])->validate();

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Pegawai::findOrFail($id);
        $pekerjaan = Pekerjaan::all();

        return view('pegawai.edit', [
            'pegawai' => $data,
            'pekerjaan' => $pekerjaan
        ]);

    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'pekerjaan_id' => 'required',
            'nama' => 'required|string',
            'email' => 'required|email|unique:sedayuHS_543905_pegawai,email,' . $id,
            'gender' => 'required|in:male,female',
        ])->validate();

        Pegawai::findOrFail($id)->update($request->all());

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }
}
