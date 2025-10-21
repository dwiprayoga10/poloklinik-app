<x-layouts.app title="Data Pasien">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">

                {{-- Alert flash message --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h1 class="mb-4">Data Pasien</h1>

                <a href="{{ route('pasien.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Tambah Pasien
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pasien</th>
                                <th>Email</th>
                                <th>No. KTP</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pasiens as $pasien)
                                <tr>
                                    <td>{{ $pasien->nama }}</td>
                                    <td>{{ $pasien->email }}</td>
                                    <td>{{ $pasien->no_ktp }}</td>
                                    <td>{{ $pasien->no_hp }}</td>
                                    <td>{{ $pasien->alamat }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pasien ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">
                                        Belum ada Pasien
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }
        }, 2000);
    </script>

    <style>
        table th, table td {
            vertical-align: middle !important;
        }

        .btn i {
            margin-right: 4px;
        }
    </style>

</x-layouts.app>
