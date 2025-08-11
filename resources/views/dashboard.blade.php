@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Statistics Row -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
            <div class="card h-100">
                <div class="stat-card bg-primary">
                    <div class="stat-card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-card-title">Total Jadwal</div>
                    <div class="stat-card-value">{{ $total_schedules }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
            <div class="card h-100">
                <div class="stat-card bg-success">
                    <div class="stat-card-icon">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <div class="stat-card-title">Jadwal Aktif</div>
                    <div class="stat-card-value">{{ $active_schedules }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
            <div class="card h-100">
                <div class="stat-card bg-info">
                    <div class="stat-card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card-title">Jadwal Selesai</div>
                    <div class="stat-card-value">{{ $completed_schedules }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100">
                <div class="stat-card bg-warning">
                    <div class="stat-card-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-card-title">Tugas Tertunda</div>
                    <div class="stat-card-value">{{ $pending_tasks }}</div>
                </div>
            </div>
        </div>
    </div>
    
    @if(auth()->user()->hasRole('worker'))
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Tugas Saya</span>
                <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-list me-1"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if(isset($my_tasks) && count($my_tasks) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Jadwal</th>
                                    <th>Tenggat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($my_tasks as $task)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="priority-indicator priority-{{ $task->priority }}"></span>
                                                <span>{{ $task->title }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $task->productionSchedule->title }}</td>
                                        <td>
                                            <span class="due-date {{ now() > $task->due_date ? 'text-danger' : '' }}">
                                                {{ $task->due_date->format('d M Y H:i') }}
                                            </span>
                                        </td>
                                             <td>
                                                <span class="badge bg-{{ $task->status == 'pending' ? 'warning' : ($task->status == 'in-progress' ? 'info' : 'success') }}">
                                                {{ ucfirst($task->status) }}
                                                </span>
                                            </td>
                                        <td>
                                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h4>Tidak ada tugas yang tertunda</h4>
                        <p>Anda tidak memiliki tugas yang perlu diselesaikan saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    @elseif(auth()->user()->hasRole('manager') || auth()->user()->hasRole('admin'))
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Jadwal Produksi Terbaru</span>
                        <a href="{{ route('production-schedules.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-list me-1"></i> Lihat Semua
                        </a>
                    </div>
                    <div class="card-body">
                        @if(isset($recent_schedules) && count($recent_schedules) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Lini Produksi</th>
                                            <th>Waktu Mulai</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_schedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->title }}</td>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        {{ $schedule->production_line }}
                                                    </span>
                                                </td>
                                                <td>{{ $schedule->start_time->format('d M Y H:i') }}</td>
                                                <td>
                                                    @php
                                                        $progress = $schedule->target_quantity > 0 
                                                            ? round(($schedule->completed_quantity / $schedule->target_quantity) * 100) 
                                                            : 0;
                                                    @endphp
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar bg-{{ $progress < 30 ? 'danger' : ($progress < 70 ? 'warning' : 'success') }}" 
                                                            role="progressbar" 
                                                            style="width: {{ $progress }}%;" 
                                                            aria-valuenow="{{ $progress }}" 
                                                            aria-valuemin="0" 
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ $progress }}%</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $schedule->status == 'pending' ? 'warning' : ($schedule->status == 'active' ? 'primary' : 'success') }}">
                                                        {{ ucfirst($schedule->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('production-schedules.show', $schedule->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye me-1"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h4>Belum ada jadwal produksi</h4>
                                <p>Mulai buat jadwal produksi untuk mengoptimalkan proses manufaktur.</p>
                                <a href="{{ route('production-schedules.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Buat Jadwal Baru
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Statistik Pekerja</span>
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-users me-1"></i> Kelola Pengguna
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="dashboard-stat mb-4">
                            <div class="stat-icon bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-details">
                                <div class="stat-title">Total Pekerja</div>
                                <div class="stat-value">{{ $workers_count ?? 0 }}</div>
                            </div>
                        </div>
                        
                        <div class="dashboard-stat mb-4">
                            <div class="stat-icon bg-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-details">
                                <div class="stat-title">Tugas Selesai Bulan Ini</div>
                                <div class="stat-value">{{ $completed_tasks_month ?? 0 }}</div>
                            </div>
                        </div>
                        
                        <div class="dashboard-stat">
                            <div class="stat-icon bg-info">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-details">
                                <div class="stat-title">Jadwal Aktif Saat Ini</div>
                                <div class="stat-value">{{ $active_schedules }}</div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <a href="{{ route('production-schedules.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Buat Jadwal Baru
                            </a>
                            <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary">
                                <i class="fas fa-tasks me-1"></i> Buat Tugas Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.empty-state {
    text-align: center;
    padding: 30px 20px;
}

.empty-state-icon {
    font-size: 3rem;
    color: #d1d1d1;
    margin-bottom: 15px;
}

.empty-state h4 {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: #333;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 20px;
}

.priority-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
}

.priority-1 {
    background-color: #6c757d;
}

.priority-2 {
    background-color: #0dcaf0;
}

.priority-3 {
    background-color: #0d6efd;
}

.priority-4 {
    background-color: #ffc107;
}

.priority-5 {
    background-color: #dc3545;
}

.due-date.text-danger {
    font-weight: 600;
}

.dashboard-stat {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 10px;
    background-color: #f8f9fa;
    transition: all 0.3s;
}

.dashboard-stat:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-right: 15px;
}

.stat-details {
    flex-grow: 1;
}

.stat-title {
    font-size: 0.8rem;
    color: #6c757d;
    margin-bottom: 5px;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 600;
    color: #212529;
}
</style>
@endsection
