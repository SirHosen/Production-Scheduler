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
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Konten Laporan</h6>
                        </div>
                        <div class="card-body">
                            {!! nl2br(e($report->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
