@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detail Laporan</h1>
                <div>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->id() == $report->created_by || auth()->user()->hasRole('admin'))
                        <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">{{ $report->title }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <strong>Tipe:</strong> {{ ucfirst($report->report_type) }}
                            </div>
                            <div>
                                <strong>Tanggal:</strong> {{ $report->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <strong>Dibuat Oleh:</strong> {{ $report->creator->name }}
                        </div>
                        @if($report->productionSchedule)
                            <div class="mb-3">
                                <strong>Jadwal Produksi:</strong>
                                <a href="{{ route('production-schedules.show', $report->productionSchedule->id) }}">
                                    {{ $report->productionSchedule->title }}
                                </a>
                            </div>
                        @endif
                        @if($report->task)
                            <div class="mb-3">
                                <strong>Tugas Terkait:</strong>
                                <a href="{{ route('tasks.show', $report->task->id) }}">
                                    {{ $report->task->title }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Konten Laporan</h6>
                        </div>
                        <div class="card-body">
                            {!! nl2br(e($report->content)) !!}
                        </div>
                    </div>

                    @if($report->task && $report->task->assignedUser)
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Penanggung Jawab</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mx-auto text-center">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="mb-1">Laporan ini terkait dengan tugas yang ditanggungjawabi oleh:</p>
                                        <h5 class="mb-0">{{ $report->task->assignedUser->name }}</h5>
                                    </div>
                                    <div class="signature-placeholder mb-2">
                                        <i class="fas fa-signature fa-2x text-muted"></i>
                                    </div>
                                    <p class="text-muted small">
                                        Penanggung jawab tugas: {{ $report->task->title }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
