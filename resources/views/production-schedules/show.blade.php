@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detail Jadwal Produksi</h1>
                <div>
                    <a href="{{ route('production-schedules.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                        <a href="{{ route('production-schedules.edit', $schedule->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Jadwal</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Judul:</th>
                                    <td>{{ $schedule->title }}</td>
                                </tr>
                                <tr>
                                    <th>Lini Produksi:</th>
                                    <td>{{ $schedule->production_line }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge bg-{{ $schedule->status == 'pending' ? 'warning' : ($schedule->status == 'active' ? 'primary' : 'success') }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat Oleh:</th>
                                    <td>{{ $schedule->creator->name ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Waktu Mulai:</th>
                                    <td>{{ $schedule->start_time->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Selesai:</th>
                                    <td>{{ $schedule->end_time->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Target Kuantitas:</th>
                                    <td>{{ $schedule->target_quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Kuantitas Selesai:</th>
                                    <td>{{ $schedule->completed_quantity }} ({{ $schedule->target_quantity > 0 ? round(($schedule->completed_quantity / $schedule->target_quantity) * 100) : 0 }}%)</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($schedule->description)
                        <div class="mt-4">
                            <h6>Deskripsi:</h6>
                            <p>{{ $schedule->description }}</p>
                        </div>
                    @endif

                    @if($schedule->notes)
                        <div class="mt-4">
                            <h6>Catatan:</h6>
                            <p>{{ $schedule->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tugas Terkait</h5>
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                        <a href="{{ route('tasks.create', ['schedule_id' => $schedule->id]) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Tugas
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if(count($schedule->tasks) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Ditugaskan Kepada</th>
                                        <th>Tenggat</th>
                                        <th>Prioritas</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedule->tasks as $task)
                                        <tr class="priority-{{ $task->priority }}">
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->assignedUser->name ?? 'Belum ditugaskan' }}</td>
                                            <td>{{ $task->due_date->format('d M Y H:i') }}</td>
                                            <td>{{ $task->priority }}</td>
                                            <td>
                                                <span class="badge bg-{{ $task->status == 'pending' ? 'warning' : ($task->status == 'in-progress' ? 'primary' : 'success') }}">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center py-3">Tidak ada tugas yang terkait dengan jadwal ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
