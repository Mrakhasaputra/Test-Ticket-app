<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h3 class="fw-bold text-primary mb-4">Daftar Ticket</h3>

    {{-- Notifikasi sukses atau error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tombol dan Filter --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <a href="{{ route('tickets.create') }}" class="btn btn-success">+ Tambah Ticket</a>
        </div>
        <div class="col-md-8 d-flex justify-content-end gap-2">
            <form action="{{ route('tickets.index') }}" method="GET" class="w-50">
                <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari judul tiket">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
            <form action="{{ route('tickets.index') }}" method="GET" class="w-50">
                <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Cari nama lengkap">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
            <div>
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </div>

    {{-- Tabel Tiket --}}
    <table class="table table-hover table-bordered shadow-sm rounded-3 overflow-hidden">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Judul</th>
                <th>Jenis Tiket</th>
                <th>Proyek</th>
                <th>Tanggal Masalah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $index => $ticket)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->ticket_type->name ?? '-' }}</td>
                    <td>{{ $ticket->project->name ?? '-' }}</td>
                    <td>{{ $ticket->assign_at }}</td>
                    <td>
                        <span class="badge 
                            @if($ticket->status === 'open') bg-warning text-dark
                            @elseif($ticket->status === 'progress') bg-info
                            @elseif($ticket->status === 'closed') bg-success
                            @elseif($ticket->status === 'cancel') bg-secondary
                            @endif">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus tiket ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" @if($ticket->status !== 'cancel') disabled @endif>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">Tidak ada tiket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
