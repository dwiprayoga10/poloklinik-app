<x-layouts.app title="Data Poli">

```
{{-- Alert pesan sukses atau umum --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mt-3" role="alert" id="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('message'))
    <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show shadow-sm mt-3" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 fw-bold text-primary">Daftar Poli</h1>
                <a href="{{ route('polis.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Poli
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th style="width: 30%;">Nama Poli</th>
                                    <th style="width: 50%;">Keterangan</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($polis as $poli)
                                    <tr>
                                        <td class="fw-semibold">{{ $poli->nama_poli }}</td>
                                        <td>{{ $poli->keterangan }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('polis.edit', $poli->id) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('polis.destroy', $poli->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus Poli ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Belum ada data Poli.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Script: Hilangkan alert otomatis --}}
<script>
    setTimeout(() => {
        const alert = document.getElementById('alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 300);
        }
    }, 3000);
</script>
```

</x-layouts.app>
