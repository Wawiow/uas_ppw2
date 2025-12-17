@extends('base')
@section('title','Tambah Pegawai')

@section('content')
<section class="p-4 bg-white rounded-lg max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Tambah Pegawai</h1>

    <form action="{{ route('pegawai.store') }}" method="POST" class="space-y-4">
        @csrf

        <input type="text" name="nama" placeholder="Nama"
               class="w-full rounded border px-3 py-2" required>

        <input type="email" name="email" placeholder="Email"
               class="w-full rounded border px-3 py-2" required>

        <select name="pekerjaan_id" class="w-full rounded border px-3 py-2" required>
            <option value="">-- Pilih Pekerjaan --</option>
            @foreach($pekerjaan as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
        </select>

        <select name="gender" class="w-full rounded border px-3 py-2" required>
            <option value="">-- Gender --</option>
            <option value="male">Laki-laki</option>
            <option value="female">Perempuan</option>
        </select>


        <select name="is_active" class="w-full rounded border px-3 py-2" required>
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
        </select>

        <button class="w-full rounded bg-green-600 py-2 text-white">
            Simpan
        </button>
    </form>
</section>
@endsection
