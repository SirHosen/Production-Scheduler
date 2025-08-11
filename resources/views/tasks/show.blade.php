@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detail Tugas</h1>
                <div>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Tugas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Judul:</th>
                                    <td>{{ $task->title }}</td>
                                </tr>
                                <tr>
                                    <th>Jadwal Produksi:</th>
                                    <td>
                                        <a href="{{ route('production-schedules.show', $task->productionSchedule->id) }}">
                                            {{ $task->productionSchedule->title }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ditugaskan Kepada:</th>
                                    <td>{{ $task->assignedUser->name ?? 'Belum ditugaskan' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Tenggat:</th>
                                    <td>{{ $task->due_date->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Prioritas:</th>
                                    <td>{{ $task->priority }} {{ $task->priority == 1 ? '(Rendah)' : ($task->priority == 5 ? '(Tinggi)' : '') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if(auth()->user()->id == $task->assigned_to || auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                                            <form action="{{ route('tasks.update-status', $task->id) }}" method="POST" class="d-flex">
                                                @csrf
                                                <select name="status" class="form-select form-select-sm me-2">
                                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            </form>
                                        @else
                                            <span class="badge bg-{{ $task->status == 'pending' ? 'warning' : ($task->status == 'in-progress' ? 'primary' : 'success') }}">
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($task->description)
                        <div class="mt-4">
                            <h6>Deskripsi:</h6>
                            <p>{{ $task->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
