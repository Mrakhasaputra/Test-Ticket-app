<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white py-3 rounded-top-4">
            <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Formulir Tiket</h4>
        </div>

        <form action="{{ route('tickets.store') }}" method="POST" class="p-4">
            @csrf

            {{-- Notifikasi Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                {{-- Kolom Kiri --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Masalah</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi <span class="text-muted">(opsional)</span></label>
                        <textarea name="description" class="form-control" rows="5"></textarea>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Tiket</label>
                        <select name="ticket_type_id" class="form-select" required>
                            <option selected disabled>Pilih Jenis Tiket</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Masalah</label>
                        <input type="date" name="assign_at" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Proyek Terkait</label>
                        <select name="project_id" class="form-select" required>
                            <option selected disabled>Pilih Proyek</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-grid gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-send-plus me-1"></i> Buat Tiket</button>
                <a href="{{ route('tickets.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>

{{-- Bootstrap Icons --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
