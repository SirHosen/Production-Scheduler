@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Laporan</h1>
                <div>
                    <a href="{{ route('reports.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Laporan Baru
                    </a>
                    <a href="{{ route('reports.export') }}" class="btn btn-success">
                        <i class="fas fa-file-export"></i> Export Laporan
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <form action="{{ route('reports.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <select name="type" class="form-select">
                                <option value="">Semua Tipe</option>
                                <option value="daily" {{ request('type') == 'daily' ? 'selected' : '' }}>Harian</option>
                                <option value="incident" {{ request('type') == 'incident' ? 'selected' : '' }}>Insiden</option>
                                <option value="quality" {{ request('type') == 'quality' ? 'selected' : '' }}>Kualitas</option>
                                <option value="maintenance" {{ request('type') == 'maintenance' ? 'selected' : '' }}>Pemeliharaan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="schedule_id" class="form-select">
                                <option value="">Semua Jadwal</option>
                                @foreach(\App\Models\ProductionSchedule::orderBy('title')->get() as $schedule)
                                    <option value="{{ $schedule->id }}" {{ request('schedule_id') == $schedule->id ? 'selected' : '' }}>
                                        {{ $schedule->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-secondary">Filter</button>
                            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if(count($reports) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Tipe</th>
                                        <th>Jadwal Produksi</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                        <tr>
                                            <td>{{ $report->title }}</td>
                                            <td>{{ ucfirst($report->report_type) }}</td>
                                            <td>{{ $report->productionSchedule->title ?? 'N/A' }}</td>
                                            <td>{{ $report->creator->name }}</td>
                                            <td>{{ $report->created_at->format('d M Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('reports.show', $report->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    @if(auth()->id() == $report->created_by || auth()->user()->hasRole('admin'))
                                                        <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                                <i class="fas fa-trash"></i> Hapus
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
                        <div class="d-flex justify-content-center mt-4">
                            {{ $reports->links() }}
                        </div>
                    @else
                        <p class="text-center py-3">Tidak ada laporan yang ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
