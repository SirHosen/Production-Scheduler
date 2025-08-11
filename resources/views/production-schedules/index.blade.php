@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Jadwal Produksi</h1>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                <a href="{{ route('production-schedules.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Jadwal Baru
                </a>
                @endif
            </div>

            <!-- Filter Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{ route('production-schedules.index') }}" method="GET">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="production_line" class="form-label">Lini Produksi</label>
                                <select name="production_line" id="production_line" class="form-select">
                                    <option value="">Semua Lini</option>
                                    @foreach($productionLines as $line)
                                        <option value="{{ $line }}" {{ request('production_line') == $line ? 'selected' : '' }}>
                                            {{ $line }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter me-1"></i> Filter
                                    </button>
                                    <a href="{{ route('production-schedules.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-redo me-1"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Schedules Table Card -->
            <div class="card shadow">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0">Daftar Jadwal</h5>
                </div>
                <div class="card-body">
                    @if(count($schedules) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Judul</th>
                                        <th>Lini Produksi</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Target</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedules as $schedule)
                                        <tr>
                                            <td class="fw-medium">{{ $schedule->title }}</td>
                                            <td>{{ $schedule->production_line }}</td>
                                            <td>{{ $schedule->start_time->format('d M Y H:i') }}</td>
                                            <td>{{ $schedule->end_time->format('d M Y H:i') }}</td>
                                            <td>{{ $schedule->target_quantity }}</td>
                                            <td>
                                                @php
                                                    $statusClasses = [
                                                        'pending' => 'bg-warning',
                                                        'active' => 'bg-primary',
                                                        'completed' => 'bg-success'
                                                    ];
                                                    $statusClass = $statusClasses[$schedule->status] ?? 'bg-secondary';
                                                @endphp
                                                <span class="badge {{ $statusClass }} rounded-pill">
                                                    {{ ucfirst($schedule->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('production-schedules.show', $schedule->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                                                        <a href="{{ route('production-schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('production-schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus" 
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $schedules->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center py-4 my-3">
                            <i class="fas fa-info-circle me-2 fs-4"></i>
                            <span>Tidak ada jadwal produksi yang ditemukan.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
