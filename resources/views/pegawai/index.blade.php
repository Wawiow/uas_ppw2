@extends('base')
@section('title','Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')

@section('content')
<section class="p-4 bg-white rounded-lg min-h-[50vh]">
    <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Pegawai</h1>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div id="success-alert"
             class="mb-4 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('success-alert')?.remove();
            }, 3000);
        </script>
    @endif

    <div class="mx-auto max-w-screen-xl">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ route('pegawai.add') }}"
               class="rounded-md bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                Tambah Pegawai
            </a>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-x divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700" width="1">No</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Pekerjaan</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Gender</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700" width="1">Aksi</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($data as $k => $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{ $data->firstItem() + $k }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">
                            {{ $p->nama }}
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            {{ $p->email }}
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            {{ $p->pekerjaan->nama ?? '-' }}
                        </td>

                        {{-- Gender --}}
                        <td class="px-4 py-3 text-center">
                            @if($p->gender === 'male')
                                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                    Laki-laki
                                </span>
                            @else
                                <span class="rounded-full bg-pink-100 px-3 py-1 text-xs font-semibold text-pink-700">
                                    Perempuan
                                </span>
                            @endif
                        </td>

                        {{-- Status Aktif --}}
                        <td class="px-4 py-3 text-center">
                            @if($p->is_active)
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="px-4 py-3 text-center">
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <a href="{{ route('pegawai.edit', $p->id) }}"
                                   class="rounded-l-md border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-50">
                                    Edit
                                </a>
                                <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus data pegawai?')"
                                            class="rounded-r-md border border-l-0 border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            Data pegawai kosong
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $data->links() }}
        </div>
    </div>
</section>
@endsection
