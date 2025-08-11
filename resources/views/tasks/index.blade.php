@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Manajemen Tugas</h1>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Tugas Baru
                </a>
                @endif
            </div>

            <div class="card">
                <div class="card-header">
    <form action="{{ route('tasks.index') }}" method="GET" class="row g-3">
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="priority" class="form-label">Prioritas</label>
            <select name="priority" id="priority" class="form-select">
                <option value="">Semua Prioritas</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ request('priority') == $i ? 'selected' : '' }}>
                        {{ $i }} {{ $i == 1 ? '(Rendah)' : ($i == 5 ? '(Tinggi)' : '') }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <label for="schedule_id" class="form-label">Jadwal Produksi</label>
            <select name="schedule_id" id="schedule_id" class="form-select">
                <option value="">Semua Jadwal</option>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->id }}" {{ request('schedule_id') == $schedule->id ? 'selected' : '' }}>
                        {{ $schedule->title }}
                    </option>
                @endforeach
            </select>
        </div>
        
        
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
</div>

                <div class="card-body">
                    @if(count($tasks) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Jadwal</th>
                                        <th>Ditugaskan Kepada</th>
                                        <th>Tenggat</th>
                                        <th>Prioritas</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr class="priority-{{ $task->priority }}">
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->productionSchedule->title ?? 'N/A' }}</td>
                                            <td>{{ $task->assignedUser->name ?? 'Belum ditugaskan' }}</td>
                                            <td>{{ $task->due_date->format('d M Y H:i') }}</td>
                                            <td>{{ $task->priority }}</td>
                                            <td>
                                                @if(auth()->user()->id == $task->assigned_to || auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                                                    <select class="form-select form-select-sm update-status" data-task-id="{{ $task->id }}">
                                                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                @else
                                                    <span class="badge bg-{{ $task->status == 'pending' ? 'warning' : ($task->status == 'in-progress' ? 'primary' : 'success') }}">
                                                        {{ ucfirst($task->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
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
                            {{ $tasks->links() }}
                        </div>
                    @else
                        <p class="text-center py-3">Tidak ada tugas yang ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.update-status').change(function() {
        let taskId = $(this).data('task-id');
        let status = $(this).val();
        
        $.ajax({
            url: '/tasks/' + taskId + '/update-status',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                alert('Status tugas berhasil diperbarui.');
            },
            error: function(response) {
                alert('Terjadi kesalahan saat memperbarui status tugas. Silakan coba lagi.');
            }
        });
    });
});
</script>
@endsection
