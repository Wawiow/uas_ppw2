@extends('base')
@section('title','Edit Pegawai')

@section('content')
<section class="p-4 bg-white rounded-lg max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Edit Pegawai</h1>

    <form action="{{ route('pegawai.update',$pegawai->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="nama" value="{{ $pegawai->nama }}"
               class="w-full rounded border px-3 py-2" required>

        <input type="email" name="email" value="{{ $pegawai->email }}"
               class="w-full rounded border px-3 py-2" required>

        <select name="pekerjaan_id" class="w-full rounded border px-3 py-2">
            @foreach($pekerjaan as $p)
                <option value="{{ $p->id }}"
                    {{ $pegawai->pekerjaan_id == $p->id ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
            @endforeach
        </select>

        <select name="gender" class="w-full rounded border px-3 py-2">
            <option value="male" {{ $pegawai->gender=='male'?'selected':'' }}>Laki-laki</option>
            <option value="female" {{ $pegawai->gender=='female'?'selected':'' }}>Perempuan</option>
        </select>

        <select name="is_active" class="w-full rounded border px-3 py-2">
            <option value="1" {{ $pegawai->is_active?'selected':'' }}>Aktif</option>
            <option value="0" {{ !$pegawai->is_active?'selected':'' }}>Nonaktif</option>
        </select>

        <button class="w-full rounded bg-blue-600 py-2 text-white">
            Update
        </button>
    </form>
</section>
@endsection
