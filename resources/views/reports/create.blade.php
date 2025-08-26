@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Buat Laporan Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf
<<<<<<< HEAD
                        
=======

>>>>>>> 2db00e5 (update)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Laporan</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_type" class="form-label">Tipe Laporan</label>
                                    <select class="form-select @error('report_type') is-invalid @enderror" id="report_type" name="report_type" required>
                                        <option value="daily" {{ old('report_type') == 'daily' ? 'selected' : '' }}>Harian</option>
                                        <option value="incident" {{ old('report_type') == 'incident' ? 'selected' : '' }}>Insiden</option>
                                        <option value="quality" {{ old('report_type') == 'quality' ? 'selected' : '' }}>Kualitas</option>
                                        <option value="maintenance" {{ old('report_type') == 'maintenance' ? 'selected' : '' }}>Pemeliharaan</option>
                                    </select>
                                    @error('report_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
<<<<<<< HEAD
                        
=======

>>>>>>> 2db00e5 (update)
                        <div class="mb-3">
                            <label for="production_schedule_id" class="form-label">Jadwal Produksi (Opsional)</label>
                            <select class="form-select @error('production_schedule_id') is-invalid @enderror" id="production_schedule_id" name="production_schedule_id">
                                <option value="">Pilih Jadwal</option>
                                @foreach($schedules as $schedule)
                                    <option value="{{ $schedule->id }}" {{ old('production_schedule_id') == $schedule->id ? 'selected' : '' }}>
                                        {{ $schedule->title }} ({{ $schedule->production_line }})
                                    </option>
                                @endforeach
                            </select>
                            @error('production_schedule_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
<<<<<<< HEAD
                        
=======

                        <div class="mb-3">
                            <label for="task_id" class="form-label">Tugas Terkait (Opsional)</label>
                            <select class="form-select @error('task_id') is-invalid @enderror" id="task_id" name="task_id">
                                <option value="">Pilih Tugas</option>
                                @foreach($tasks as $task)
                                    <option value="{{ $task->id }}" {{ old('task_id') == $task->id ? 'selected' : '' }}>
                                        {{ $task->title }} (Penanggung jawab: {{ $task->assignedUser ? $task->assignedUser->name : 'Tidak ada' }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">
                                Pilih tugas untuk menunjukkan penanggung jawab pada laporan ini
                            </small>
                            @error('task_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

>>>>>>> 2db00e5 (update)
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten Laporan</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
<<<<<<< HEAD
                        
=======

>>>>>>> 2db00e5 (update)
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
