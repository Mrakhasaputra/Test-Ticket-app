<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-gradient bg-primary text-white rounded-top-4 py-3 px-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold"><i class="bi bi-ticket-perforated me-2"></i> Detail Tiket #{{ $ticket->id }}</h4>
        </div>
        <div class="card-body px-4 py-5">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong><i class="bi bi-person-fill me-1"></i> Nama Lengkap:</strong> {{ $ticket->name }}</p>
                    <p><strong><i class="bi bi-envelope-fill me-1"></i> Email:</strong> {{ $ticket->email }}</p>
                    <p><strong><i class="bi bi-card-heading me-1"></i> Judul:</strong> {{ $ticket->title }}</p>
                    <p><strong><i class="bi bi-tag-fill me-1"></i> Jenis Tiket:</strong> {{ $ticket->ticket_type->name ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="bi bi-collection-fill me-1"></i> Proyek:</strong> {{ $ticket->project->name ?? '-' }}</p>
                    <p><strong><i class="bi bi-calendar-event me-1"></i> Tanggal Masalah:</strong> {{ $ticket->assign_at }}</p>
                    <p><strong><i class="bi bi-info-circle-fill me-1"></i> Status:</strong> 
                        <span class="badge fs-6 
                            @if($ticket->status === 'open') bg-warning text-dark
                            @elseif($ticket->status === 'progress') bg-info
                            @elseif($ticket->status === 'closed') bg-success
                            @elseif($ticket->status === 'cancel') bg-secondary
                            @endif">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <hr>

            <div class="mt-4">
                <h5 class="fw-bold"><i class="bi bi-chat-left-text-fill me-2"></i>Deskripsi Masalah</h5>
                <div class="bg-light border rounded p-3">
                    {!! $ticket->description ? nl2br(e($ticket->description)) : '<em>Tidak ada deskripsi.</em>' !!}
                </div>
            </div>
        </div>
        <div class="card-footer px-4 py-3 d-flex justify-content-end align-items-center gap-2 ">
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary w-100">Kembali</a>
        </div>
    </div>
</div>

{{-- Bootstrap Icons --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
