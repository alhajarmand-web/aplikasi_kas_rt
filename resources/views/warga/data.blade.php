@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Data Warga</h3>
    <a href="/warga/create" class="btn btn-success">Tambah Warga</a>
</div>

<!-- SEARCH -->
<form method="GET" action="/warga" class="mb-4">
    <div class="row">

        <div class="col-md-4">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari nama / alamat / no hp"
                value="{{ request('search') }}"
            >
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">
                Cari
            </button>
        </div>

    </div>
</form>

<div class="card card-custom p-3">

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-primary">
                <tr>
                    <th width="60">No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($warga as $item)

                <tr>

                    <td>
                        {{ $loop->iteration + ($warga->firstItem() - 1) }}
                    </td>

                    <td>{{ $item->nama }}</td>

                    <td>{{ $item->alamat }}</td>

                    <td>{{ $item->no_hp }}</td>

                    <td>

                        <a href="/warga/edit/{{ $item->id }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="/warga/delete/{{ $item->id }}"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus data?')">
                            Hapus
                        </a>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">
                        Data tidak ditemukan
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-3">
        {{ $warga->links() }}
    </div>

</div>

@endsection