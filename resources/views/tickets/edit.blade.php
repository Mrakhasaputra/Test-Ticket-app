<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-5" style="max-width: 800px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i> Ubah Tiket</h4>
        </div>

        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="p-4">
            @csrf
            @method('PUT')

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
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $ticket->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $ticket->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Tiket</label>
                        <select name="ticket_type_id" class="form-select" required>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $type->id == $ticket->ticket_type_id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="progress" {{ $ticket->status == 'progress' ? 'selected' : '' }}>Progress</option>
                            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            <option value="cancel" {{ $ticket->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                        </select>
                    </div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
                <a href="{{ route('tickets.index') }}" class="btn btn-secondary"><i class="bi bi-x-circle me-1"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
